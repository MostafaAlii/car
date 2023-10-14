<?php

namespace App\Http\Resources\Drivers;

use App\Models\Captain;
use App\Models\CaptainProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsCaptionStatusResources extends JsonResource
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
            'cars_caption_id' => $this->cars_caption_id ?? null,
            'captain_profile_id' => $this->captain_profile_id ?? null,
            'status' => $this->status,
            'photo' => getUrlPhoto($this->type_photo, $this->cars_caption_id != null ? $this->cars_caption->captain->id : $this->captain_profile->captain->id, $this->name_photo),
            'type_photo' => $this->type_photo,
            'name_photo' => $this->name_photo,
            'reject_message' => $this->reject_message,

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