<?php

namespace App\Http\Controllers\Api\Users;

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
            return $this->successResponse(Notification::where('user_id', auth('users-api')->id())->paginate(50), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
