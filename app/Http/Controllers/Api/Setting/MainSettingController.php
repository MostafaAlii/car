<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Resources\AboutUsResources;
use App\Http\Resources\ConditionsResources;
use App\Http\Resources\PrivacyResources;
use App\Http\Resources\YearResources;
use App\Models\AboutUs;
use App\Models\Conditions;
use App\Models\Privacy;
use App\Models\Settings;
use App\Models\Years;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Traits\Api\ApiResponseTrait;
use App\Http\Resources\MainSetting\MainSettingResources;
use Illuminate\Support\Facades\Validator;

class MainSettingController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            return $this->successResponse(MainSettingResources::collection(Settings::get()), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function accounts_kilometer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kilometer' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        if ((mainsSettings()->open_door && mainsSettings()->kilo_price && mainsSettings()->country_tax) > 0) {

            $price_kilo_price = $request->kilometer * mainsSettings()->kilo_price;
            $price_country_tax = ($price_kilo_price * mainsSettings()->country_tax) / 100;
            $price_company_commission = ($price_kilo_price * mainsSettings()->company_commission) / 100;
            $price_company_tax = ($price_kilo_price * mainsSettings()->company_tax) / 100;

            $total_price = mainsSettings()->open_door + $price_kilo_price + $price_country_tax + $price_company_commission + $price_company_tax;

            $price_suggestion_1 = $total_price + 5;
            $price_suggestion_2 = $price_suggestion_1 + 5;
            $price_suggestion_3 = $price_suggestion_2 + 5;
            return $this->successResponse(['price_Basic' => ceil($total_price), ceil($price_suggestion_1), ceil($price_suggestion_2), ceil($price_suggestion_3)], 'Price Total In Ride');


        } else {
            return $this->errorResponse('Something went wrong, please try again later');
        }

    }


    public function carYear()
    {
        try {
            return $this->successResponse(YearResources::collection(Years::get()), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function aboutUs()
    {
        try {
            return $this->successResponse(new AboutUsResources(AboutUs::first()) ,'data Return Successfully');

        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }

    }
    public function conditions()
    {
        try {
            return $this->successResponse(new ConditionsResources(Conditions::first()) ,'data Return Successfully');

        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }

    }

    public function privacies()
    {
        try {
            return $this->successResponse(new PrivacyResources(Privacy::first()) ,'data Return Successfully');

        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }

    }

    public function checkYears(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'years' => 'required|date_format:Y',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }
        try {
            return $this->successResponse(checkYears($request->years), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
