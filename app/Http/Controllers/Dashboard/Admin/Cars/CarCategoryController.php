<?php

namespace App\Http\Controllers\Dashboard\Admin\Cars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{Admins\Cars\CarCategoryService};
use App\DataTables\Dashboard\Admin\Cars\CarCategoryDataTable;
use App\Http\Requests\Dashboard\Admin\Cars\CarCategoryRequestValidation;
class CarCategoryController extends Controller
{
    public function __construct(protected CarCategoryDataTable $dataTable, protected CarCategoryService $carCategoryService) {
        $this->dataTable = $dataTable;
        $this->carCategoryService = $carCategoryService;
    }
    
    public function index() {
        $data = [
            'title' => 'Car-Category',
        ];
        return $this->dataTable->render('dashboard.admin.cars.carCategory.index',  compact('data'));
    }

    public function store(CarCategoryRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->carCategoryService->create($requestData);
            return redirect()->route('carCategories.index')->with('success', 'car category created successfully');
        } catch (\Exception $e) {
            return redirect()->route('carCategories.index')->with('error', 'An error occurred while creating the car category');
        }
    }

    public function update(CarCategoryRequestValidation $request, $carCategoryId) {
        try {
            $requestData = $request->validated();
            $this->carCategoryService->update($carCategoryId, $requestData);
            return redirect()->route('carCategories.index')->with('success', 'car category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carCategories.index')->with('error', 'An error occurred while updating the car category');
        }
    }

    public function updateStatus(Request $request, $carCategoryId) {
        try {
            $this->carCategoryService->updateStatus($carCategoryId, $request->status);
            return redirect()->route('carCategories.index')->with('success', 'car category status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carCategories.index')->with('error', 'An error occurred while updating the car category');
        }
    }

    public function destroy($id) {  
        try {
            $this->carCategoryService->delete($id);
            return redirect()->route('carCategories.index')->with('success', 'car category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('carType.index')->with('error', 'An error occurred while deleting the car type');
        }
    }
}
