<?php
namespace App\Models\Traits\Api;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{CaptainProfile,CarsCaptionStatus, CarsCaption};
use Illuminate\Support\Facades\Storage;
trait ImageUploadTrait {
    public function uploadProfileImage(Request $request, CaptainProfile $captain, array $namePhotoArray, string $type_photo, $foldername, $disk) {
        foreach ($namePhotoArray as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $extension = $file->getClientOriginalExtension();
                $pictureName = $field . '.' . $extension;
                $path = $file->storeAs($foldername . '/' . $type_photo, $pictureName, $disk);
                $status = new CarsCaptionStatus();
                $status->captain_profile_id = $captain->id;
                $status->status = 'not_active';
                $status->type_photo = $type_photo;
               $status->name_photo = $field;
                // $status->name_photo = $pictureName;
                $status->save();
                $captain->$field = $pictureName;
                $captain->save();
            }
        }
    }


    public function uploadCarImage(Request $request, CarsCaption $captain, array $namePhotoArray, string $type_photo, $foldername, $disk) {
        foreach ($namePhotoArray as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $extension = $file->getClientOriginalExtension();
                $pictureName = $field . '.' . $extension;
                $path = $file->storeAs($foldername . '/' . $type_photo, $pictureName, $disk);
                $status = new CarsCaptionStatus();
                $status->cars_caption_id = $captain->id;
                $status->status = 'not_active';
                $status->type_photo = $type_photo;
               $status->name_photo = $field;
                // $status->name_photo = $pictureName;
                $status->save();
                $captain->$field = $pictureName;
                $captain->save();
            }
        }
    }



}
