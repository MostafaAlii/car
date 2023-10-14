<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarModelResources;
use App\Models\CarModel;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            return $this->successResponse(CarModelResources::collection(CarModel::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new CarModelResources(CarModel::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
