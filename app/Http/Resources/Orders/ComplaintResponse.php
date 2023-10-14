<?php

namespace App\Http\Resources\Orders;

use App\Http\Resources\Drivers\CaptionResources;
use App\Http\Resources\Users\UsersResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'order_id' => new OrdersResources($this->order),
            'messages'=> $this->messages,
            'type'=> $this->type,
            'user_id' => new UsersResources($this->user) ?? null,
            'captain_id' => new CaptionResources($this->captain) ?? null,
            'photo' => asset($this->photo),
            'status'=> $this->status,
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
