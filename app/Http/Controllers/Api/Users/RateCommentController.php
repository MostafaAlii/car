<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\RateCommentUserResources;
use App\Models\CaptainProfile;
use App\Models\Order;
use App\Models\User;
use App\Models\RateComment;
use App\Models\Traits\Api\ApiResponseTrait;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RateCommentController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try {
            $data = RateComment::where('user_id', auth('users-api')->id())->get();
            return $this->successResponse(RateCommentUserResources::collection($data), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_code' => 'required|exists:orders,order_code',
//            'user_id' => 'required|exists:users,id',
            'rate' => 'required|numeric|between:1,5',
            'comment' => 'nullable|string',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        try {
            $findOrder = Order::where('order_code', $request->order_code)->first();
            $data = RateComment::create([
                'order_id' => $findOrder->id,
                'user_id' => $findOrder->user_id,
                'captain_id' => $findOrder->captain_id,
                'rate' => $request->rate,
                'comment' => $request->comment ?? null,
                'type' => 'user',
            ]);

            if ($data) {
                $users = User::findorfail($findOrder->user_id);
                sendNotificationUser($users->fcm_token, "شكرا على تقيمكم", '');

                $rateUserCount = RateComment::where('user_id', $findOrder->user_id)->count();
                $rateUserSum = RateComment::where('user_id', $findOrder->user_id)->sum('rate');

                if ($rateUserCount && $rateUserSum) {
                    UserProfile::where('user_id', $findOrder->user_id)->update([
                        'rate' => number_format($rateUserSum / $rateUserCount, 1),
                    ]);
                }

                return $this->successResponse(new RateCommentUserResources($data), 'data Return Successfully');


            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }



}
