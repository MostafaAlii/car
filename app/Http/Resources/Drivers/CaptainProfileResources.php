<?php

namespace App\Http\Resources\Drivers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaptainProfileResources extends JsonResource
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
            'amountDay' => getTotalAmountDay($this->captain_id),
            'wallet' => $this->captainWallet(),
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'rate' => $this->rate,
            'number_trips' => $this->number_trips,

            'photo_id_before' => $this->photo_id_before,
            'photo_id_before_status' => (new CarsCaptionStatusResources($this->profileStatus()))
                ->where('name_photo', $this->photo_id_before)
                ->first() ?? null,


            'photo_id_behind' => $this->photo_id_behind,
            'photo_id_behind_status' => (new CarsCaptionStatusResources($this->profileStatus()))
                ->where('name_photo', $this->photo_id_behind)
                ->first() ?? null,

            'photo_driving_before' => $this->photo_driving_before,
            'photo_driving_before_status' => (new CarsCaptionStatusResources($this->profileStatus()))
                ->where('name_photo', $this->photo_driving_before)
                ->first() ?? null,


            'photo_driving_behind' => $this->photo_driving_behind,
            'photo_driving_behind_status' => (new CarsCaptionStatusResources($this->profileStatus()))
                ->where('name_photo', $this->photo_driving_behind)
                ->first() ?? null,

            'photo_criminal' => $this->photo_criminal,
            'photo_criminal_status' => (new CarsCaptionStatusResources($this->profileStatus()))
                ->where('name_photo', $this->photo_criminal_status)
                ->first() ?? null,

            'photo_personal' => $this->photo_personal,
            'photo_personal_status' => (new CarsCaptionStatusResources($this->profileStatus()))
                ->where('name_photo', $this->photo_personal)
                ->first() ?? null,

            'number_personal' => $this->number_personal,

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
