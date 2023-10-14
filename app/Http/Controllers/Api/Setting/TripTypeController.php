<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripTypeResources;
use App\Models\Traits\Api\ApiResponseTrait;
use App\Models\TripType;
use Illuminate\Http\Request;

class TripTypeController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        try {
            return $this->successResponse(TripTypeResources::collection(TripType::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new TripTypeResources(TripType::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
