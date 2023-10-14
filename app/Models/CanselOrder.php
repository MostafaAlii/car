<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanselOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'cansel',
        'user_id',
        'type',
        'captain_id',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function captain()
    {
        return $this->belongsTo(Captain::class, 'captain_id');
    }
}
