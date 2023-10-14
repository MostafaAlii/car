<?php

namespace App\Http\Resources\Drivers;

use App\Http\Resources\CarMakeResources;
use App\Http\Resources\CarModelResources;
use App\Http\Resources\CarTypeResources;
use App\Http\Resources\CategoryCarResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsCaptionResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'car_make_id' => new CarMakeResources($this->car_make),
            'car_model_id' => new CarModelResources($this->car_model),
            'car_type_id' => new CarTypeResources($this->car_type),
            'category_car_id' => new CategoryCarResources($this->category_car),

            'number_car' => $this->number_car,
            'color_car' => $this->color_car,

            'car_photo_before' => $this->car_photo_before,
            'car_photo_before_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_photo_before)
                    ->first() ?? null,


            'car_photo_behind' => $this->car_photo_behind,
            'car_photo_behind_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_photo_behind)
                    ->first() ?? null,


            'car_photo_right' => $this->car_photo_right,
            'car_photo_right_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_photo_right)
                    ->first() ?? null,

            'car_photo_north' => $this->car_photo_north,
            'car_photo_north_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_photo_north)
                    ->first() ?? null,


            'car_photo_inside' => $this->car_photo_inside,
            'car_photo_inside_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_photo_inside)
                    ->first() ?? null,


            'car_license_before' => $this->car_license_before,
            'car_license_before_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_license_before)
                    ->first() ?? null,


            'car_license_behind' => $this->car_license_behind,
            'car_license_behind_status' => (new CarsCaptionStatusResources($this->carsStatus()))
                    ->where('name_photo', $this->car_license_behind)
                    ->first() ?? null,

            'create_dates' => [
                'created_at_human' => $this->created_at->diffForHumans(),
                'created_at' => $this->created_at
            ],
            'update_dates' => [
                'updated_at_human' => $this->updated_at->diffForHumans(),
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
