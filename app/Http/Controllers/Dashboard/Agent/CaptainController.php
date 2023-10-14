<?php

namespace App\Http\Controllers\Dashboard\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Dashboard\Agent\CaptainDataTable;
use App\Http\Requests\Dashboard\Agent\CaptionRequestValidation;
use App\Services\Dashboard\{Agents\CaptainService,General\GeneralService};

class CaptainController extends Controller
{
    public function __construct(protected CaptainDataTable $dataTable, protected CaptainService $captainService, protected GeneralService $generalService) {
        $this->dataTable = $dataTable;
        $this->captainService = $captainService;
        $this->generalService = $generalService;
    }
    
    public function index() {
        $data = [
            'title' => 'Captions',
            'countries' => $this->generalService->getCountries(),
        ];
        return $this->dataTable->render('dashboard.agent.captains.index',  compact('data'));
    }

    public function show($captainId) {
        try {
            $data = [
                'title' => 'Captain Details',
                'captain' => $this->captainService->getProfile($captainId),
            ];
            return view('dashboard.agent.captains.show', compact('data'));
        } catch (\Exception $e) {
            return redirect()->route('agentCaptains.index')->with('error', 'An error occurred while getting the captain details');
        }
    }

    public function store(CaptionRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->captainService->create($requestData);
            return redirect()->route('agentCaptains.index')->with('success', 'captain created successfully');
        } catch (\Exception $e) {
            return redirect()->route('agentCaptains.index')->with('error', 'An error occurred while creating the captain');
        }
    }

    public function update(CaptionRequestValidation $request, $captainId) {
        try {
            $requestData = $request->validated();
            $this->captainService->update($captainId, $requestData);
            return redirect()->route('agentCaptains.index')->with('success', 'captain updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('agentCaptains.index')->with('error', 'An error occurred while updating the captain');
        }
    }

    public function updatePassword(Request $request, $captainId) {
        try {
            $this->captainService->updatePassword($captainId, $request->password);
            return redirect()->route('agentCaptains.index')->with('success', 'captain password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('agentCaptains.index')->with('error', 'An error occurred while updating the captain password');
        }
    }

    public function destroy($id) {  
        try {
            $this->captainService->delete($id);
            return redirect()->route('agentCaptains.index')->with('success', 'captain deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('agentCaptains.index')->with('error', 'An error occurred while deleting the captain');
        }
    }

    public function notifications($captainId) {
        try {
            return $this->captainService->getNotifications($captainId);
        } catch (\Exception $e) {
            return redirect()->route('agentCaptains.index')->with('error', 'An error occurred while getting the captain notifications');
        }
    }
}
