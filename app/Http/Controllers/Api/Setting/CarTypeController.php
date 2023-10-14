<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarTypeResources;
use App\Models\CarType;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        try {
            return $this->successResponse(CarTypeResources::collection(CarType::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new CarTypeResources(CarType::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
