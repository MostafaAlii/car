<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarMake extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function status() {
        return $this->status ? 'Active' : 'No Active';
    }

    public function scopeActive() {
        return $this->whereStatus(true)->get();
    }

    public function carModel()
    {
        return $this->hasMany(CarModel::class,'car_make_id');
    }


}
