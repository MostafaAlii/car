<?php

namespace App\Http\Controllers\Api\complaint;

use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\ComplaintResponse;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    use ApiResponseTrait;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_code' => 'required|exists:orders,order_code',
            'user_id' => 'required_if:type,user|exists:users,id',
            'captain_id' => 'required_if:type,captain|exists:captains,id',
            'type' => 'required|in:user,captain',
            'messages' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        try {


            $orders = Order::where('order_code', $request->order_code)->first();

            $checkUser = Complaint::where('order_id',$orders->id)->where('user_id',$request->user_id)->first();
            if ($checkUser){
                return $this->errorResponse('The Orders Exiting Complaint');
            }

            $checkCaptain = Complaint::where('order_id',$orders->id)->where('captain_id',$request->captain_id)->first();
            if ($checkCaptain){
                return $this->errorResponse('The Orders Exiting Complaint');
            }

            if ($request->hasFile('photo')) {
                $imageName = time() . '.' . $request->photo->extension();
                // Public Folder
                $files = $request->photo->move('complaint', $imageName);
            }
            if ($request->type == "user") {
                $data = Complaint::create([
                    'order_id' => $orders->id,
                    'messages' => $request->messages,
                    'type' => $request->type,
                    'user_id' => $request->user_id,
                    'photo' => $files ?? null,
                    'status' => "pending",
                ]);
            } else {
                $data = Complaint::create([
                    'order_id' => $orders->id,
                    'messages' => $request->messages,
                    'type' => $request->type,
                    'captain_id' => $request->captain_id,
                    'photo' => $files ?? null,
                    'status' => "pending",
                ]);
            }
            return $this->successResponse(new ComplaintResponse($data), 'data created successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');

        }


    }
}
