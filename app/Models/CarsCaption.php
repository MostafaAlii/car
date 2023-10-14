<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsCaption extends Model
{
    use HasFactory;
    protected $table = 'cars_captions';

    protected $fillable = [
        'captain_id',
        'car_make_id',
        'car_model_id',
        'car_type_id',
        'category_car_id',
        'number_car',
        'color_car',
        'year_car',
        'car_photo_before',
        'car_photo_behind',
        'car_photo_right',
        'car_photo_north',
        'car_photo_inside',
        'car_license_before',
        'car_license_behind',
    ];

    public function captain()
    {
        return $this->belongsTo(Captain::class,'captain_id');
    }

    public function car_make()
    {
        return $this->belongsTo(CarMake::class,'car_make_id');
    }
    public function car_model()
    {
        return $this->belongsTo(CarModel::class,'car_model_id');
    }

    public function car_type()
    {
        return $this->belongsTo(CarType::class,'car_type_id');
    }

    public function category_car()
    {
        return $this->belongsTo(CategoryCar::class,'category_car_id');
    }

    public function carsStatus()
    {
        return $this->hasMany(CarsCaptionStatus::class,'cars_caption_id');
    }
}