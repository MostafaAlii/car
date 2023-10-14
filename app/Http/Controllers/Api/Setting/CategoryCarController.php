<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCarResources;
use App\Models\CategoryCar;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryCarController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        try {
            return $this->successResponse(CategoryCarResources::collection(CategoryCar::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new CategoryCarResources(CategoryCar::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
