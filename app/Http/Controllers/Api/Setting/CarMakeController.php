<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarMakeResources;
use App\Models\CarMake;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class CarMakeController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            return $this->successResponse(CarMakeResources::collection(CarMake::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            return  $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new CarMakeResources(CarMake::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
