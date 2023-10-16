<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model {
    use HasFactory;
    protected $fillable = [
        'photo_status',
        'filename',
        'type',
        'reject_reson',

    ];
    public $timestamps = false;
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    public function captainProfile() {
        return $this->belongsTo(CaptainProfile::class, 'imageable_id');
    }
}
