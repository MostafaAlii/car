<?php

namespace App\Http\Controllers\Dashboard\Admin\Cars;
use App\Models\CarMake;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\{Admins\Cars\CarModelService};
use App\DataTables\Dashboard\Admin\Cars\CarModelDataTable;
use App\Http\Requests\Dashboard\Admin\Cars\CarModelRequestValidation;

class CarModelController extends Controller
{
    public function __construct(protected CarModelDataTable $dataTable, protected CarModelService $carModelService) {
        $this->dataTable = $dataTable;
        $this->carModelService = $carModelService;
    }
    
    public function index() {
        $data = [
            'title' => 'Car-Model',
            'car_makes' => CarMake::active(),
        ];
        return $this->dataTable->render('dashboard.admin.cars.carModel.index',  compact('data'));
    }

    public function store(CarModelRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->carModelService->create($requestData);
            return redirect()->route('carModel.index')->with('success', 'car model created successfully');
        } catch (\Exception $e) {
            return redirect()->route('carModel.index')->with('error', 'An error occurred while creating the car model');
        }
    }

    public function update(CarModelRequestValidation $request, $carModelId) {
        try {
            $requestData = $request->validated();
            $this->carModelService->update($carModelId, $requestData);
            return redirect()->route('carModel.index')->with('success', 'car model updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carModel.index')->with('error', 'An error occurred while updating the car model');
        }
    }

    public function updateStatus(Request $request, $carModelId) {
        try {
            $this->carModelService->updateStatus($carModelId, $request->status);
            return redirect()->route('carModel.index')->with('success', 'car model status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carModel.index')->with('error', 'An error occurred while updating the car model');
        }
    }

    public function destroy($id) {  
        try {
            $this->carModelService->delete($id);
            return redirect()->route('carModel.index')->with('success', 'car model deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('carModel.index')->with('error', 'An error occurred while deleting the car model');
        }
    }
}
