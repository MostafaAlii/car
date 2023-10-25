<?php

namespace App\Http\Controllers\Api\Drivers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Admins\CaptainService;
use App\Models\Traits\Api\{ApiResponseTrait, ImageUploadTrait};
use App\Models\{Captain, CaptainProfile, CarsCaption, CarsCaptionStatus};
use App\Http\Resources\Drivers\{CarsCaptionResources, CaptainProfileResources, CarsCaptionStatusResources};

class CaptainProfileController extends Controller
{
    use ApiResponseTrait, ImageUploadTrait;
    public function __construct(protected CaptainService $captainService)
    {
        $this->captainService = $captainService;
    }

    public function index()
    {
        try {
            $data = CaptainProfile::where('captain_id', auth('captain-api')->id())->first();
            return $this->successResponse(new CaptainProfileResources($data), 'data Return Successfully');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }
    }

    public function uploadProfile(Request $request) {
        try {
            $user = auth('captain-api')->user();

            if (!$user) {
                return $this->errorResponse('Sorry, you are not allowed', 403);
            }

            $numberPersonal = $request->input('number_personal');
            if ($numberPersonal) {
                $user->profile->update(['number_personal' => $numberPersonal]);
            }

            $carData = [
                'captain_id' => $user->id,
                'number_car' => $request->input('number_car'),
                'color_car' => $request->input('color_car'),
                'year_car' => $request->input('year_car'),
            ];

            CarsCaption::updateOrInsert(['captain_id' => $user->id], $carData);

            $allowedPersonalImageTypes = [
                'personal_avatar',
                'id_photo_front',
                'id_photo_back',
                'criminal_record',
                'captain_license_front',
                'captain_license_back',
            ];
            $allowedCarImageTypes = [
                'car_license_front',
                'car_license_back',
                'car_front',
                'car_back',
                'car_right',
                'car_left',
                'car_inside',
            ];
            $imageType = $request->input('type');

            if ($imageType === 'personal') {
                foreach ($allowedPersonalImageTypes as $imageField) {
                    if ($request->hasFile($imageField)) {
                        $this->storeImage($request, $imageField, $imageType, $user);
                    }
                }
            } elseif ($imageType === 'car') {
                foreach ($allowedCarImageTypes as $imageField) {
                    if ($request->hasFile($imageField)) {
                        $this->storeImage($request, $imageField, $imageType, $user);
                    }
                }
            } else {
                return $this->errorResponse('Invalid image type', 400);
            }

            return $this->successResponse('Upload Profile Media Successfully for ' . $user->name);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while uploading the profile media: ' . $e->getMessage());
        }
    }


    public function updateUploadProfile(Request $request) {

        $user = auth('captain-api')->user();
        if (!$user) {
            return $this->errorResponse('Sorry, you are not allowed', 403);
        }

        $imageType = $request->input('type');
        $captainFolderName = str_replace(' ', '_', $user->name) . '_' . $user->captainProfile->uuid;
        if (!in_array($imageType, ['personal', 'car'])) {
            return $this->errorResponse('Invalid image type', 400);
        }

        $path_image = asset('dashboard/img/' . $captainFolderName . '/' . $request->input('type'));

        $imageTypes = [
            'personal_avatar',
            'id_photo_front',
            'id_photo_back',
            'criminal_record',
            'captain_license_front',
            'captain_license_back',
            'car_license_front',
            'car_license_back',
            'car_front',
            'car_back',
            'car_right',
            'car_left',
            'car_inside',
        ];

        foreach ($imageTypes as $imageType) {
            $oldImage = Image::where([
                'imageable_type' => 'App\Models\Captain',
                'imageable_id' => $user->id,
                'photo_type' => $imageType,
            ])->first();

            if ($oldImage) {
                $filePath = $path_image . '/' . $oldImage->filename;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $oldImage->delete();
            }

            if ($request->hasFile($imageType)) {
                $newImage = $request->file($imageType);
                $imageTypePhoto = $imageType . '.' . $newImage->getClientOriginalExtension();

                $newImage->move($path_image, $imageTypePhoto);

                $image = new Image();
                $image->photo_type = $imageType;
                $image->imageable_type = 'App\Models\Captain';
                $image->filename = $imageTypePhoto;
                $image->imageable_id = $user->id;
                $image->photo_status = 'not_active';
                $image->type = $request->input('type');
                $image->save();
            }
        }

        return $this->successResponse('Profile images updated successfully');

    }
    public function getRejectMedia(Request $request)
    {
        try {
            $user = auth('captain-api')->user();
            if (!$user) {
                return $this->errorResponse('Sorry, you are not allowed', 403);
            }
            $captainFolderName = str_replace(' ', '_', $user->name) . '_' . $user->captainProfile->uuid;
            $rejectedImages = Image::where([
                'imageable_type' => 'App\Models\Captain',
                'imageable_id' => $user->id,
                'photo_status' => 'rejected',
            ])->get();
            $mediaData = [];

            foreach ($rejectedImages as $image) {
                $imageType = $image->type;
                $imageTypeFolder = $imageType === 'personal' ? 'personal' : 'car';

                $mediaData[] = [
                    'photo_status' => $image?->photo_status,
                    'photo_type' => $image?->photo_type,
                    'reject_reason' => $image?->reject_reson,
                    'type' => $image?->type,
                    'image_path' => asset('dashboard/img/' . $captainFolderName . '/' . $imageTypeFolder . '/' . $image->filename),
                ];
            }

            $responseData = [
                'message' => 'Rejected media retrieved successfully',
                'data' => $mediaData,
            ];

            return response()->json($responseData);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving rejected media: ' . $e->getMessage());
        }
    }

    public function allMedia(Request $request)
    {
        try {
            $user = auth('captain-api')->user();
            if (!$user) {
                return $this->errorResponse('Sorry, you are not allowed', 403);
            }
            $imageType = $request->input('type');
            $imageTypeFolder = in_array($imageType, ['car', 'personal']) ? $imageType : 'default';
            $captainFolderName = str_replace(' ', '_', $user->name) . '_' . $user->captainProfile->uuid;
            $allMedia = Image::where([
                'imageable_type' => 'App\Models\Captain',
                'imageable_id' => $user->id,
                'type' => $imageType,
            ])->get();
            $mediaData = [];
            foreach ($allMedia as $image) {
                $mediaData[] = [
                    'photo_status' => $image->photo_status,
                    'photo_type' => $image->photo_type,
                    'reject_reason' => $image->reject_reson,
                    'image_path' => asset('dashboard/img/' . $captainFolderName . '/' . $imageTypeFolder . '/' . $image->filename),
                ];
            }
            $responseData = [
                'message' => 'All media retrieved successfully',
                'data' => $mediaData,
            ];
            return response()->json($responseData);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while retrieving media: ' . $e->getMessage());
        }
    }

    public function checkImg(Request $request) {
        try {
            $user = auth('captain-api')->user();
            $captainFolderName = str_replace(' ', '_', $user->name) . '_' . $user->captainProfile->uuid;
            if (!$user)
                return $this->errorResponse('Sorry, you are not allowed', 403);

            $requiredPersonalFields = [
                'personal_avatar',
                'id_photo_front',
                'id_photo_back',
                'criminal_record',
                'captain_license_front',
                'captain_license_back',
            ];

            $requiredCarFields = [
                'car_license_front',
                'car_license_back',
                'car_front',
                'car_back',
                'car_right',
                'car_left',
                'car_inside',
            ];

            $matchingPersonalImages = Image::where([
                'imageable_type' => 'App\Models\Captain',
                'imageable_id' => $user->id,
            ])->whereIn('photo_type', $requiredPersonalFields)->get();

            $matchingCarImages = Image::where([
                'imageable_type' => 'App\Models\Captain',
                'imageable_id' => $user->id,
            ])->whereIn('photo_type', $requiredCarFields)->get();

            $personalFieldsComplete = count($matchingPersonalImages) === count($requiredPersonalFields);
            $carFieldsComplete = count($matchingCarImages) === count($requiredCarFields);

            $response = [
                'captain_personal' => $personalFieldsComplete,
                'captain_car' => $carFieldsComplete,
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while checking media: ' . $e->getMessage());
        }
    }
    private function storeImage(Request $request, $field, $type, $imageable) {
        $image = new Image();
        $image->photo_type = $field;
        $image->imageable_type = 'App\Models\Captain';
        $imageable = json_decode($imageable);

        if ($request->file($field)->isValid()) {
            $captainProfile = CaptainProfile::whereCaptainId($imageable->id)->select('uuid')->first();
            if ($captainProfile) {
                $nameWithoutSpaces = str_replace(' ', '_', $imageable->name);
                $userDirectory = $nameWithoutSpaces . '_' . $captainProfile->uuid;
                $typeDirectory = $type;
                $originalFileName = $request->file($field)->getClientOriginalName();
                $filename = $field . '.' . $request->file($field)->getClientOriginalExtension();
                $path = $userDirectory . '/' . $typeDirectory . '/';
                $request->file($field)->storeAs($path, $originalFileName, 'upload_image');
                $image->photo_status = 'not_active';
                $image->type = $type;
                $image->filename = $originalFileName;
                //$image->filename = $filename;
                $image->imageable_id = $imageable->id;
                $image->save();
            }
        }
    }

    public function uploadCarPhoto(Request $request)
    {
        try {
            $user = auth('captain-api')->user();
            if (!$user)
                return $this->errorResponse('Sorry, you are not allowed', 403);
            $captainCar = $user->car;
            if (!$captainCar)
                return $this->errorResponse('Sorry, you do not have a car');
            $namePhotoArray = ['car_photo_before', 'car_photo_behind', 'car_photo_right', 'car_photo_north', 'car_photo_inside', 'car_license_before', 'car_license_behind'];
            $type_photo = 'car';
            $originalCaptainName = Captain::whereId($captainCar->captain_id)->first()->name;
            $cleanedCaptainName = str_replace(' ', '_', $originalCaptainName);
            $foldername = $user->profile->uuid . '_' . $cleanedCaptainName;
            $disk = 'upload_image';
            CarsCaption::where('captain_id', auth('captain-api')->id())->update([
                'car_make_id' => $request->car_make_id,
                'car_model_id' => $request->car_model_id,
                'car_type_id' => $request->car_type_id,
                'category_car_id' => checkYears($request->years),
                'number_car' => $request->number_car,
                'color_car' => $request->color_car,
            ]);
            $additionalFields = $request->only(['car_make_id', 'car_model_id', 'car_type_id', 'category_car_id', 'number_car', 'color_car']);
            $captainCar->update($additionalFields);
            $this->uploadCarImage($request, $captainCar, $namePhotoArray, $type_photo, $foldername, $disk);
            return $this->successResponse('Upload Car Media Successfully for ' . $user->name);
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while uploading the car media: ' . $e->getMessage());
        }
    }

    public function getCar()
    {
        try {
            $data = CarsCaption::where('captain_id', auth('captain-api')->id())->first();
            if (isset($data)) {
                return $this->successResponse(new CarsCaptionResources($data), 'data Return Successfully');
            }
            return $this->successResponse('', 'No Cars In Caption');
        } catch (\Exception $exception) {
            return $this->errorResponse('Something went wrong, please try again later');
        }


    }

    public function getCaptainPhotosWithStatus()
    {
        $captain = CaptainProfile::where('captain_id', auth('captain-api')->id())->first();
        if (!$captain)
            return $this->errorResponse('Captain profile not found', 404);
        $response = [];
        $photoColumns = [
            'photo_id_before',
            'photo_id_behind',
            'photo_driving_before',
            'photo_driving_behind',
            'photo_criminal',
            'photo_personal',
        ];
        foreach ($photoColumns as $column) {
            $mediaFileStatus = CarsCaptionStatus::where('captain_profile_id', $captain->id)
                ->where('type_photo', 'personal')
                ->where('name_photo', $column)
                ->first();
            if ($mediaFileStatus) {
                $cleanedCaptainName = str_replace(' ', '_', $captain->owner->name);
                $response[] = [
                    'name_photo' => $column,
                    'status' => $mediaFileStatus->status,
                    'image' => $captain->{$column} ? asset('dashboard/img/' . $captain->uuid . '_' . $cleanedCaptainName . '/' . 'personal/' . $captain->{$column}) : null,
                    'reject_message' => $mediaFileStatus->reject_message
                ];

            } else {
                return $this->errorResponse('No media file status found for ' . $column, 404);
            }
        }
        return $this->successResponse($response, 'Profile Media files status retrieved successfully for ' . $captain->owner->name);
    }

    public function getCaptainCarsPhotosWithStatus()
    {
        $captain = CarsCaption::with('captain')->where('captain_id', auth('captain-api')->id())->first();
        if (!$captain)
            return $this->errorResponse('Captain cars media not found', 404);
        $response = [];
        $photoColumns = [
            'car_photo_before',
            'car_photo_behind',
            'car_photo_right',
            'car_photo_north',
            'car_photo_inside',
            'car_license_before',
            'car_license_behind',
        ];
        foreach ($photoColumns as $column) {
            $mediaFileStatus = CarsCaptionStatus::where('cars_caption_id', $captain->id)
                ->where('type_photo', 'car')
                ->where('name_photo', $column)
                ->first();
            if ($mediaFileStatus) {
                $cleanedCaptainName = str_replace(' ', '_', $captain->captain->name);
                $response[] = [
                    'name_photo' => $column,
                    'status' => $mediaFileStatus->status,
                    'image' => $captain->{$column} ? asset('dashboard/img/' . $captain->captain->captainProfile->uuid . '_' . $cleanedCaptainName . '/' . 'car/' . $captain->{$column}) : null,
                    'reject_message' => $mediaFileStatus->reject_message
                ];

            } else {
                return $this->errorResponse('No media file status found for ' . $column, 404);
            }
        }
        return $this->successResponse($response, 'Car Media files status retrieved successfully for ' . $captain->captain->name);
    }

    public function checkUploadfilesOrNot()
    {
        $captain = auth('captain-api')->user();
        if (!$captain)
            return $this->errorResponse('Sorry, you are not allowed', 403);
        $profilePhotos = [
            'photo_id_before',
            'photo_id_behind',
            'photo_driving_before',
            'photo_driving_behind',
            'photo_criminal',
            'photo_personal',
        ];
        $carPhotos = [
            'car_photo_before',
            'car_photo_behind',
            'car_photo_right',
            'car_photo_north',
            'car_photo_inside',
            'car_license_before',
            'car_license_behind',
        ];

        $profilePhotosCount = 0;
        $carPhotosCount = 0;

        $captainProfile = CaptainProfile::where('captain_id', $captain->id)->first();
        if ($captainProfile) {
            foreach ($profilePhotos as $column) {
                if ($captainProfile->{$column}) {
                    $profilePhotosCount++;
                }
            }
        }
        $captainCar = CarsCaption::where('captain_id', $captain->id)->first();
        if ($captainCar) {
            foreach ($carPhotos as $column) {
                if ($captainCar->{$column}) {
                    $carPhotosCount++;
                }
            }
        }
        if ($profilePhotosCount > 0 && $carPhotosCount > 0) {
            //return $this->successResponse('data','Captain has uploaded photos.');
            return $response[] = [
                'profilePhotos' => true,
                'carPhotos' => true,
            ];
        } elseif ($profilePhotosCount > 0) {
            //return $this->successResponse('Captain has uploaded photos to captain profiles.');
            return $response[] = [
                'profilePhotos' => true,
                'carPhotos' => false,
            ];
        } elseif ($carPhotosCount > 0) {
            //return $this->successResponse('Captain has uploaded photos to cars captions.');
            return $response[] = [
                'carPhotos' => true,
                'profilePhotos' => false,
            ];
        } else {
            //return $this->errorResponse('Captain has not uploaded any photos.');
            return $response[] = [
                'carPhotos' => false,
                'profilePhotos' => false,
            ];
        }
    }

}