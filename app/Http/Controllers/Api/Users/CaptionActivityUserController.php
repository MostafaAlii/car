<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\CaptionActivityUserResources;
use App\Models\CaptionActivity;
use App\Models\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaptionActivityUserController extends Controller
{
    use ApiResponseTrait;
    public function captionActivity(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

//        try {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

//            $radius = Settings::first()->ocean ?? 10; // قطر البحث بالكيلومترات
            $radius = 50;
            $captains = CaptionActivity::where('status_captain_work','active')->where('status_captain','active')->where('type_captain','active')->selectRaw("
            *,
            (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance
      ")
                ->having('distance', '<', $radius)
                ->orderBy('distance')
                ->get();

            return $this->successResponse(CaptionActivityUserResources::collection($captains), 'Data returned successfully');

//        } catch (\Exception $exception) {
//            return $this->errorResponse('Something went wrong, please try again later');
//        }



    }
}
