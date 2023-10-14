<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResources;
use App\Models\Subscription;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {

        try {
            return $this->successResponse(SubscriptionResources::collection(Subscription::active()), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse(new SubscriptionResources(Subscription::findorfail($id)), 'data Return Successfully');
        } catch (\Exception $exception) {
            $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
