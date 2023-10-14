<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Drivers\CaptionResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaptionActivityUserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        return [
            'id' => $this->id,
            'captain_id' => new CaptionResources($this->captain),
            'statistics'=> getStatisticsGoogle($latitude,$longitude,$this->latitude,$this->longitude),
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'type_captain' => $this->type_captain,
            'status_captain' => $this->status_captain,
            'status_captain_work' => $this->status_captain_work,
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
