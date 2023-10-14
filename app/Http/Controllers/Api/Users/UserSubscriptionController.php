<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserSubscriptionResources;
use App\Models\Traits\Api\ApiResponseTrait;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSubscriptionController extends Controller
{
    use ApiResponseTrait;

    public function subscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:package,subscription,offer',
            'package_id' => 'required_if:type,package|exists:packages,id',
            'subscription_id' => 'sometimes|required_if:type,subscription|exists:subscriptions,id',
            'offer_id' => 'sometimes|required_if:type,offer|exists:offers,id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

//        try {
            $userId = auth('users-api')->id();
            $type = $request->type;

            switch ($type) {
                case 'package':
                    $relation = 'package';
                    $typeItem = 'package_id';
                    break;

                case 'subscription':
                    $relation = 'subscription';
                    $typeItem = 'subscription_id';
                    break;

                case 'offer':
                    $relation = 'offer';
                    $typeItem = 'offer_id';
                    break;

                default:
                    return $this->errorResponse('Invalid subscription type', 422);
            }

            $existingSubscription = UserSubscription::where('user_id', $userId)->where($typeItem, $request->$typeItem)->first();

            if (!$existingSubscription) {
               $userSubscription = UserSubscription::create([
                    'user_id' => $userId,
                    $typeItem => $request->$typeItem,
                    'type' => $type,
                ]);

                return $this->successResponse(new UserSubscriptionResources($userSubscription), 'Successfully Subscription');
            } else {

                return $this->successResponse('', "The User's Subscription $type ($relation)");
            }
//        } catch (\Exception $exception) {
//            return $this->errorResponse('Something went wrong, please try again later');
//        }

    }
}
