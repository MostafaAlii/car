<?php
namespace App\Services\Dashboard\Admins\Cars;
use App\Models\CarModel;
class CarModelService {
    public function create($data) {
        return CarModel::create($data);
    }
    
    public function update($carModelId, $data) {
        $carModel = CarModel::findOrFail($carModelId);
        $carModel->fill($data);
        $carModel->save();
        return $carModel;
    }

    public function delete($carModelId) {
        $carModel = CarModel::findOrFail($carModelId);
        $carModel->delete();
        return $carModel;
    }

    public function updateStatus($carModelId, $status) {
        $carModel = CarModel::findOrFail($carModelId);
        $carModel->status = $status;
        $carModel->save();
        return $carModel;
    }
}