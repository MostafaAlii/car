<?php

namespace App\Http\Resources\Orders;

use App\Http\Resources\Drivers\CaptionResources;
use App\Http\Resources\Users\UsersResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanselOrderResources extends JsonResource
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
            'cansel' => $this->cansel,
            'user_id' => new UsersResources($this->user),
            'captain_id' => new CaptionResources($this->captain),
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
