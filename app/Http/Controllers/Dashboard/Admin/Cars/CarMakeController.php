<?php

namespace App\Http\Controllers\Dashboard\Admin\Cars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{Admins\Cars\CarMakeService};
use App\DataTables\Dashboard\Admin\Cars\CarMakeDataTable;
use App\Http\Requests\Dashboard\Admin\Cars\CarMakeRequestValidation;
class CarMakeController extends Controller
{
    public function __construct(protected CarMakeDataTable $dataTable, protected CarMakeService $carMakeService) {
        $this->dataTable = $dataTable;
        $this->carMakeService = $carMakeService;
    }
    
    public function index() {
        $data = [
            'title' => 'Car-Make',
        ];
        return $this->dataTable->render('dashboard.admin.cars.carMake.index',  compact('data'));
    }

    public function store(CarMakeRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->carMakeService->create($requestData);
            return redirect()->route('carMake.index')->with('success', 'car make created successfully');
        } catch (\Exception $e) {
            return redirect()->route('carMake.index')->with('error', 'An error occurred while creating the car make');
        }
    }

    public function update(CarMakeRequestValidation $request, $carMakeId) {
        try {
            $requestData = $request->validated();
            $this->carMakeService->update($carMakeId, $requestData);
            return redirect()->route('carMake.index')->with('success', 'car make updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carMake.index')->with('error', 'An error occurred while updating the car category');
        }
    }

    public function updateStatus(Request $request, $carMakeId) {
        try {
            $this->carMakeService->updateStatus($carMakeId, $request->status);
            return redirect()->route('carMake.index')->with('success', 'car make status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('carMake.index')->with('error', 'An error occurred while updating the car make');
        }
    }

    public function destroy($id) {  
        try {
            $this->carMakeService->delete($id);
            return redirect()->route('carMake.index')->with('success', 'car make deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('carMake.index')->with('error', 'An error occurred while deleting the car make');
        }
    }
}
