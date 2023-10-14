<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResources;
use App\Models\Discount;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckCodeDiscountController extends Controller
{
    use ApiResponseTrait;

    public function checkCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:discounts,code',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }


        $coupon = Discount::whereCode($request->code)->first();
        if ($coupon) {
            return $this->successResponse(new DiscountResources($coupon), 'data Code Successfully');
        }
    }
}
