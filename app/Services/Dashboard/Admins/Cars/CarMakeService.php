<?php
namespace App\Services\Dashboard\Admins\Cars;
use App\Models\CarMake;
class CarMakeService {
    public function create($data) {
        return CarMake::create($data);
    }
    
    public function update($carMakeId, $data) {
        $carMake = CarMake::findOrFail($carMakeId);
        $carMake->fill($data);
        $carMake->save();
        return $carMake;
    }

    public function delete($carMakeId) {
        $carMake = CarMake::findOrFail($carMakeId);
        $carMake->delete();
        return $carMake;
    }

    public function updateStatus($carMakeId, $status) {
        $carMake = CarMake::findOrFail($carMakeId);
        $carMake->status = $status;
        $carMake->save();
        return $carMake;
    }
}