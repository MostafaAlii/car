<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'messages',
        'type',
        'user_id',
        'captain_id',
        'photo',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
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
