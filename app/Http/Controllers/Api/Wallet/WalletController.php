<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wallet\WalletResources;
use App\Models\Traits\Api\ApiResponseTrait;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required_if:type,user|exists:users,id',
            'captain_id' => 'required_if:type,captains|exists:captains,id',
            'type' => 'required|in:user,captions',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        try {
            if ($request->type == "user") {
                $wallets = Wallet::where('user_id', $request->user_id)->get();
                return $this->successResponse(WalletResources::collection($wallets), 'data return success');
            } else {
                $wallets = Wallet::where('captain_id', $request->captain_id)->get();
                return $this->successResponse(WalletResources::collection($wallets), 'data return success');
            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');

        }

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required_if:type,user|exists:users,id',
            'captain_id' => 'required_if:type,captains|exists:captains,id',
            'type' => 'required|in:user,captions',
            'amount' => 'required|numeric',
            'status' => 'required|in:package,offer,subscriptions,card',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        try {
            if ($request->type == "user") {
                $data = Wallet::create([
                    'type'=> $request->type,
                    'user_id' => $request->user_id,
                    'status'=> $request->status,
                    'amount'=> $request->amount,
                    'payment_date'=> date('Y-m-d H:i:s'),
                ]);
                return $this->successResponse(new WalletResources($data), 'data return successfully');

            } else {
                $data = Wallet::create([
                    'type'=> $request->type,
                    'captain_id' => $request->captain_id,
                    'status'=> $request->status,
                    'amount'=> $request->amount,
                    'payment_date'=> date('Y-m-d H:i:s'),
                ]);
                return $this->successResponse(new WalletResources($data), 'data return successfully');
            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');

        }

    }
}
