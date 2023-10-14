<?php
namespace App\Services\Dashboard\Admins\Cars;
use App\Models\CategoryCar;
class CarCategoryService {
    public function create($data) {
        return CategoryCar::create($data);
    }
    
    public function update($carCategoryId, $data) {
        $carCategory = CategoryCar::findOrFail($carCategoryId);
        $carCategory->fill($data);
        $carCategory->save();
        return $carCategory;
    }

    public function delete($carCategoryId) {
        $carCategory = CategoryCar::findOrFail($carCategoryId);
        $carCategory->delete();
        return $carCategory;
    }

    public function updateStatus($carCategoryId, $status) {
        $carCategory = CategoryCar::findOrFail($carCategoryId);
        $carCategory->status = $status;
        $carCategory->save();
        return $carCategory;
    }
}