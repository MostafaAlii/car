<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Drivers\CaptionActivityResources;
use App\Models\CaptionActivity;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaptainController extends Controller
{
    use ApiResponseTrait;

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'status_captain' => 'required|in:active,inactive',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 400);
        }

        try {
            $checkCaptainStatus = CaptionActivity::where('captain_id', auth('captain-api')->id())->first();
            if ($checkCaptainStatus) {
                if ($checkCaptainStatus->status_captain_work == 'block') {
                    return $this->errorResponse('Something went wrong, please try again later', 500);
                }

                if ($checkCaptainStatus->status_captain_work == 'waiting') {
                    return $this->errorResponse('Waiting for documents to be activated', 500);
                }

                $checkCaptainStatus->update([
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'status_captain' => $request->status_captain,
                ]);
                return $this->successResponse(new CaptionActivityResources($checkCaptainStatus), 'data Updated Successfully');

            } else {
                $data = CaptionActivity::create([
                    'captain_id' => auth('captain-api')->id(),
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'type_captain' => 'active',
                    'status_captain' => $request->status_captain,
                    'status_captain_work' => "waiting",

                ]);

                if (in_array($data->status_captain_work, ['block', 'waiting'])) {
                    return $this->errorResponse('Waiting for documents to be activated', 500);
                }

            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }

    }

    public function checkStatusCaptain(Request $request)
    {
        try {
            $statusCaptain = CaptionActivity::where('captain_id', auth('captain-api')->id())->first();
            if ($statusCaptain) {
                return $this->successResponse($statusCaptain->status_captain_work, 'data return Success');

            } else {
                return $this->errorResponse('Captain is not active');

            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function StatusCaptain(Request $request)
    {
        try {
            $statusCaptain = CaptionActivity::where('captain_id', auth('captain-api')->id())->first();
            if ($statusCaptain) {
                return $this->successResponse($statusCaptain->status_captain, 'data return Success');

            } else {
                return $this->errorResponse('Captain is not active');

            }
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }
}
