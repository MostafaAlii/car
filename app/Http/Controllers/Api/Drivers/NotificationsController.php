<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResources;
use App\Models\Notification;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use ApiResponseTrait;

    public function getNotifications()
    {
        try {

            return $this->successResponse(Notification::where('captains_id', auth('captain-api')->id())->paginate(50), 'data Return Successfully');

        } catch (\Exception $exception) {
            return  $this->errorResponse('Something went wrong, please try again later');
        }

    }
}
