<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaptainProfile extends BaseModel
{
    protected $table = 'captain_profiles';
    protected $fillable = [
        'name', 'bio', 'captain_id', 'uuid', 'avatar', 'rate', 'number_trips',
        'number_trips_cansel',
        'photo_id_before',
        'photo_id_behind',
        'photo_driving_before',
        'photo_driving_behind',
        'photo_criminal',
        'photo_personal',
        'number_personal',
    ];

    public function profileStatus() {
        return $this->hasMany(CarsCaptionStatus::class,'captain_profile_id');
    }

    public function owner(): BelongsTo {
        return $this->belongsTo(related: Captain::class, foreignKey: 'captain_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'imageable_id');
    }

    public function captainWallet()
    {
        return $this->hasMany(Wallet::class,'captain_id')->sum('amount');
    }

}
