<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptionActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_id',
        'longitude',
        'latitude',
        'type_captain',
        'status_captain',
        'status_captain_work',
    ];

    public function captain()
    {
        return $this->belongsTo(Captain::class, 'captain_id');
    }
}
