<?php
namespace App\Services\Dashboard\Admins\Cars;
use App\Models\CarType;
class CarTypeService {
    public function create($data) {
        return CarType::create($data);
    }
    
    public function update($carTypeId, $data) {
        $carType = CarType::findOrFail($carTypeId);
        $carType->fill($data);
        $carType->save();
        return $carType;
    }

    public function delete($carTypeId) {
        $carType = CarType::findOrFail($carTypeId);
        $carType->delete();
        return $carType;
    }

    public function updateStatus($carTypeId, $status) {
        $carType = CarType::findOrFail($carTypeId);
        $carType->status = $status;
        $carType->save();
        return $carType;
    }
}