<?php
namespace App\Services\Dashboard\General;
use App\Models\City;
class CityService {
    public function updateStatus($cityId, $status) {
        $city = City::findOrFail($cityId);
        $city->status = $status;
        $city->save();
        return $city;
    }
}