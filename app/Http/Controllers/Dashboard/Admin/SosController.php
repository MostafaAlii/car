<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{Admins\SosService};
use App\DataTables\Dashboard\Admin\SosDataTable;
use App\Http\Requests\Dashboard\Admin\SosRequestValidation;
class SosController extends Controller
{
    public function __construct(protected SosDataTable $dataTable, protected SosService $sosService) {
        $this->dataTable = $dataTable;
        $this->sosService = $sosService;
    }
    
    public function index() {
        $data = [
            'title' => 'Sos',
        ];
        return $this->dataTable->render('dashboard.admin.sos.index',  compact('data'));
    }

    public function store(SosRequestValidation $request) {
        //dd($request->all());
        try {
            $requestData = $request->validated();
            $this->sosService->create($requestData);
            return redirect()->route('sos.index')->with('success', 'sos created successfully');
        } catch (\Exception $e) {
            return redirect()->route('sos.index')->with('error', 'An error occurred while creating the sos');
        }
    }

    public function update(SosRequestValidation $request, $sosId) {
        try {
            $requestData = $request->validated();
            $this->sosService->update($sosId, $requestData);
            return redirect()->route('sos.index')->with('success', 'sos updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('sos.index')->with('error', 'An error occurred while updating the sos');
        }
    }

    public function updateStatus(Request $request, $sosId) {
        try {
            $this->sosService->updateStatus($sosId, $request->status);
            return redirect()->route('sos.index')->with('success', 'sos password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('sos.index')->with('error', 'An error occurred while updating the sos');
        }
    }

    public function destroy($id) {  
        try {
            $this->sosService->delete($id);
            return redirect()->route('sos.index')->with('success', 'sos deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('sos.index')->with('error', 'An error occurred while deleting the sos');
        }
    }
}
