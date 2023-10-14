<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Drivers\CaptionResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateCommentUserResources extends JsonResource
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
            'admin' => $this->admin_id == true ? 'admin' : null,
            'agent' => $this->agent_id == true ? 'agent' : null,
            'employee' => $this->employee == true ? 'employee' : null,
            'user' => new UsersResources($this->user),
            'captain' => new CaptionResources($this->captain),
            'rate' => $this->rate,
            'comment' => $this->comment,
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
