<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsCaptionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'cars_caption_id',
        'captain_profile_id',
        'status',
        'type_photo',
        'name_photo',
        'reject_message',
    ];

    public function cars_caption()
    {
        return $this->belongsTo(CarsCaption::class,'cars_caption_id');
    }
    public function captain_profile()
    {
        return $this->belongsTo(CaptainProfile::class,'captain_profile_id');
    }
}
