<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\OfferResources;
use App\Http\Resources\PackageResources;
use App\Http\Resources\SubscriptionResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionResources extends JsonResource
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
            'wallet'=> $this->userWallet,
            'user' => new UsersResources($this->user),
            'package_id' => new PackageResources($this->package) ?? null,
            'subscription_id' => new SubscriptionResources($this->subscription) ?? null,
            'offer_id' =>  new OfferResources($this->offer) ?? null,
            'type' => $this->type,
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
