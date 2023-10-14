<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\{Admins\AgentService,General\GeneralService};
use App\DataTables\Dashboard\Admin\AgentDataTable;
use App\Http\Requests\Dashboard\Admin\AgentRequestValidation;

class AgentController extends Controller {
    public function __construct(protected AgentDataTable $dataTable, protected AgentService $agentService, protected GeneralService $generalService) {
        $this->dataTable = $dataTable;
        $this->agentService = $agentService;
        $this->generalService = $generalService;
    }
    
    public function index() {
        $data = [
            'title' => 'Agents',
            'countries' => $this->generalService->getCountries(),
        ];
        return $this->dataTable->render('dashboard.admin.agents.index',  compact('data'));
    }

    public function store(AgentRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->agentService->createAgent($requestData);
            return redirect()->route('agents.index')->with('success', 'Agent created successfully');
        } catch (\Exception $e) {
            return redirect()->route('agents.index')->with('error', 'An error occurred while creating the agent');
        }
    }

    public function update(AgentRequestValidation $request, $agentId) {
        try {
            $requestData = $request->validated();
            $this->agentService->updateAgent($agentId, $requestData);
            return redirect()->route('agents.index')->with('success', 'Agent updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('agents.index')->with('error', 'An error occurred while updating the agent');
        }
    }

    public function updatePassword(Request $request, $agentId) {
        try {
            $this->agentService->updatePassword($agentId, $request->password);
            return redirect()->route('agents.index')->with('success', 'Agent password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('agents.index')->with('error', 'An error occurred while updating the agent password');
        }
    }

    public function destroy($id) {  
        try {
            $this->agentService->deleteAgent($id);
            return redirect()->route('agents.index')->with('success', 'Agent deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An error occurred while deleting the agent');
        }
    }
}