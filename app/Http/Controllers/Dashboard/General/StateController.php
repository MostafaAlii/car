<?php

namespace App\Http\Controllers\Dashboard\General;

use App\DataTables\Dashboard\General\StateDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\General\StateService;

class StateController extends Controller {
    public function __construct(protected StateDataTable $stateDataTable, protected StateService $stateService) {
        $this->stateDataTable = $stateDataTable;
        $this->stateService = $stateService;
    }

    public function index() {
        return $this->stateDataTable->render('dashboard.general.states.index', ['title' => 'States']);
    }

    public function changeStatusState(Request $request, $stateId) {
        try {
            $this->stateService->updateStatus($stateId, $request->status);
            return redirect()->route('states.index')->with('success', 'State Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('states.index')->with('error', 'An error occurred while updating the State Status');
        }
    }

}