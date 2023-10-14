<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResources;
use App\Models\Offer;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        try {
            return $this->successResponse(OfferResources::collection(Offer::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new OfferResources(Offer::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
