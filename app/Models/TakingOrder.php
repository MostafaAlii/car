<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'lat_caption',
        'long_caption',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
