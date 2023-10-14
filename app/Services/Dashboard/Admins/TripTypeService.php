<?php
namespace App\Services\Dashboard\Admins;
use App\Models\TripType;
class TripTypeService {
    public function create($data) {
        return TripType::create($data);
    }
    
    public function update($tripTypeId, $data) {
        $tripType = TripType::findOrFail($tripTypeId);
        $tripType->fill($data);
        $tripType->save();
        return $tripType;
    }

    public function delete($tripTypeId) {
        $tripType = TripType::findOrFail($tripTypeId);
        $tripType->delete();
        return $tripType;
    }

    public function updateStatus($tripTypeId, $status) {
        $tripType = TripType::findOrFail($tripTypeId);
        $tripType->status = $status;
        $tripType->save();
        return $tripType;
    }
}