<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Country extends Model {
    use HasFactory;
       protected $fillable = ['name', 'status','code','logo'];

    public function states() {
        return $this->hasMany(State::class, 'country_id');
    }

    public function status() {
        return $this->status ? 'Active' : 'NO Active';
    }

    public function scopeActive() {
        return $this->whereStatus(true)->get();
    }
}
