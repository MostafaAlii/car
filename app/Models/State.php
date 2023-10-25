<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'status',
    ];

    public function cities() {
        return $this->hasMany(City::class, 'state_id');
    }

    public function status() {
        return $this->status  ? 'Active' : 'NO Active';
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    protected static function boot() {
        parent::boot();
        static::updating(function ($state) {
            $attributes = $state->getDirty();
            $state->cities->each(function ($city) use ($attributes) {
                $city->update([
                    'status' => $attributes['status'],
                ]);
            });
        });
    }
}
