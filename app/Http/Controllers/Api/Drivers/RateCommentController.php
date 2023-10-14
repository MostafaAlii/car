<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\RateCommentUserResources;
use App\Models\CaptainProfile;
use App\Models\Order;
use App\Models\Captain;
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
            $data = RateComment::where('captain_id', auth('captain-api')->id())->get();
            return $this->successResponse(RateCommentUserResources::collection($data), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_code' => 'required|exists:orders,order_code',
//            'captain_id' => 'required|exists:captains,id',
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
                'captain_id' => $findOrder->captain_id,
                'user_id' => $findOrder->user_id,
                'rate' => $request->rate,
                'comment' => $request->comment ?? null,
                'type' => 'caption',
            ]);

            if ($data) {
                $caption = Captain::findorfail($findOrder->captain_id);
                sendNotificationCaptain($caption->fcm_token, "شكرا على تقيمكم", '');

                // $users = User::findorfail($request->user_id);
                // sendNotificationUser($users->fcm_token, 'Trips Created Successfully', 'New Trips');

                $rateCaptainCount = RateComment::where('captain_id', $findOrder->captain_id)->count();
                $rateCaptainSum = RateComment::where('captain_id', $findOrder->captain_id)->sum('rate');

                if ($rateCaptainCount && $rateCaptainSum) {
                    CaptainProfile::where('captain_id', $findOrder->captain_id)->update([
                        'rate' =>  number_format($rateCaptainSum / $rateCaptainCount , 1),
                    ]);
                }

                return $this->successResponse(new RateCommentUserResources($data), 'data Return Successfully');


            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }

}
