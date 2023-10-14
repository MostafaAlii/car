<?php

namespace App\Http\Controllers\Dashboard\Admin\Cars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{Admins\Cars\CarTypeService};
use App\DataTables\Dashboard\Admin\Cars\CarTypeDataTable;
use App\Http\Requests\Dashboard\Admin\Cars\CarTypeRequestValidation;
class CarTypeController extends Controller
{
    public function __construct(protected CarTypeDataTable $dataTable, protected CarTypeService $carTypeService) {
        $this->dataTable = $dataTable;
        $this->carTypeService = $carTypeService;
    }
    
    public function index() {
        $data = [
            'title' => 'Car-Type',
        ];
        return $this->dataTable->render('dashboard.admin.cars.carType.index',  compact('data'));
    }

    public function store(CarTypeRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->carTypeService->create($requestData);
            return redirect()->route('carType.index')->with('success', 'car type created successfully');
        } catch (\Exception $e) {
            return redirect()->route('carType.index')->with('error', 'An error occurred while creating the car type');
        }
    }

    public function update(CarTypeRequestValidation $request, $carTypeId) {
        try {
            $requestData = $request->validated();
            $this->carTypeService->update($carTypeId, $requestData);
            return redirect()->route('carType.index')->with('success', 'car type updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carType.index')->with('error', 'An error occurred while updating the car type');
        }
    }

    public function updateStatus(Request $request, $carTypeId) {
        try {
            $this->carTypeService->updateStatus($carTypeId, $request->status);
            return redirect()->route('carType.index')->with('success', 'car type status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carType.index')->with('error', 'An error occurred while updating the car type');
        }
    }

    public function destroy($id) {  
        try {
            $this->carTypeService->delete($id);
            return redirect()->route('carType.index')->with('success', 'car type deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('carType.index')->with('error', 'An error occurred while deleting the car type');
        }
    }
}
