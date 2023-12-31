<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'subscription_id',
        'offer_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class,'subscription_id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id');
    }
}
