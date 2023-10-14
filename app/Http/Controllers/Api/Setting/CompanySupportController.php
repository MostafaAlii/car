<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanySupportResources;
use App\Models\CompanySupport;
use App\Models\Traits\Api\ApiResponseTrait;

class CompanySupportController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            return $this->successResponse(CompanySupportResources::collection(CompanySupport::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            return  $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
