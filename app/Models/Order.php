<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'captain_id',
        'trip_type_id',
        'order_code',
        'total_price',
        'address_now',
        'address_going',
        'chat_id',
        'status',
        'payments',
        'lat_user',
        'long_user',
        'lat_going',
        'long_going',
        'time_trips',
        'distance',
        'lat_caption',
        'long_caption',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function captain()
    {
        return $this->belongsTo(Captain::class, 'captain_id');
    }

    public function trip_type()
    {
        return $this->belongsTo(TripType::class, 'trip_type_id');
    }

    public function takingOrder()
    {
        return $this->hasOne(TakingOrder::class,'order_id');
    }

    public function rates()
    {
        return $this->hasOne(RateComment::class,'order_id');
    }

    public function canselOrder()
    {
        return $this->hasOne(CanselOrder::class,'order_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class,'order_id');
    }
    
     public function scopeByCaptain($query, $captainId)
    {
        return $query->where('captain_id', $captainId);
    }
}
