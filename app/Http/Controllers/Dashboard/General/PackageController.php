<?php

namespace App\Http\Controllers\Dashboard\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{General\PackageService};
use App\DataTables\Dashboard\General\PackageDataTable;
class PackageController extends Controller
{
    public function __construct(protected PackageDataTable $dataTable, protected PackageService $packageService) {
        $this->dataTable = $dataTable;
        $this->packageService = $packageService;
    }
    
    public function index() {
        return $this->dataTable->render('dashboard.general.packages.index',  ['title' => 'Packages']);
    }

    public function store(Request $request) {
        try {
            $requestData = $request->all();
            $this->packageService->create($requestData);
            return redirect()->route('packages.index')->with('success', 'package created successfully');
        } catch (\Exception $e) {
            return redirect()->route('packages.index')->with('error', 'An error occurred while creating the package');
        }
    }

    public function update(Request $request, $packageId) {
        try {
            $requestData = $request->all();
            $this->packageService->update($packageId, $requestData);
            return redirect()->route('packages.index')->with('success', 'package updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('packages.index')->with('error', 'An error occurred while updating the package');
        }
    }

    public function updateStatus(Request $request, $packageId) {
        try {
            $this->packageService->updateStatus($packageId, $request->status);
            return redirect()->route('packages.index')->with('success', 'package status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('packages.index')->with('error', 'An error occurred while updating the package');
        }
    }

    public function destroy($id) {  
        try {
            $this->packageService->delete($id);
            return redirect()->route('packages.index')->with('success', 'package deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('packages.index')->with('error', 'An error occurred while deleting the package');
        }
    }
}
