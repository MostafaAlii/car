<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{Admins\TripTypeService};
use App\DataTables\Dashboard\Admin\TripTypeDataTable;
use App\Http\Requests\Dashboard\Admin\TripTypeRequestValidation;
class TripTypeController extends Controller
{
    public function __construct(protected TripTypeDataTable $dataTable, protected TripTypeService $tripTypeService) {
        $this->dataTable = $dataTable;
        $this->tripTypeService = $tripTypeService;
    }
    
    public function index() {
        $data = [
            'title' => 'Trip-Type',
        ];
        return $this->dataTable->render('dashboard.admin.tripType.index',  compact('data'));
    }

    public function store(TripTypeRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->tripTypeService->create($requestData);
            return redirect()->route('tripType.index')->with('success', 'trip created successfully');
        } catch (\Exception $e) {
            return redirect()->route('tripType.index')->with('error', 'An error occurred while creating the trip');
        }
    }

    public function update(TripTypeRequestValidation $request, $tripTypeId) {
        try {
            $requestData = $request->validated();
            $this->tripTypeService->update($tripTypeId, $requestData);
            return redirect()->route('tripType.index')->with('success', 'trip updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('tripType.index')->with('error', 'An error occurred while updating the trip');
        }
    }

    public function updateStatus(Request $request, $tripTypeId) {
        try {
            $this->tripTypeService->updateStatus($tripTypeId, $request->status);
            return redirect()->route('tripType.index')->with('success', 'trip password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('tripType.index')->with('error', 'An error occurred while updating the trip');
        }
    }

    public function destroy($id) {  
        try {
            $this->tripTypeService->delete($id);
            return redirect()->route('tripType.index')->with('success', 'trip deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('tripType.index')->with('error', 'An error occurred while deleting the trip');
        }
    }
}
