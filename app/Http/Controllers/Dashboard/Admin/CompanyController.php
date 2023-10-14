<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{Admins\CompanyService,General\GeneralService};
use App\DataTables\Dashboard\Admin\CompanyDataTable;
use App\Http\Requests\Dashboard\Admin\CompanyRequestValidation;
class CompanyController extends Controller
{
    public function __construct(protected CompanyDataTable $dataTable, protected CompanyService $companyService, protected GeneralService $generalService) {
        $this->dataTable = $dataTable;
        $this->companyService = $companyService;
        $this->generalService = $generalService;
    }
    
    public function index() {
        $data = [
            'title' => 'Companies',
            'countries' => $this->generalService->getCountries(),
        ];
        return $this->dataTable->render('dashboard.admin.companies.index',  compact('data'));
    }

    public function store(CompanyRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->companyService->create($requestData);
            return redirect()->route('companies.index')->with('success', 'company created successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'An error occurred while creating the company');
        }
    }

    public function update(CompanyRequestValidation $request, $companyId) {
        try {
            $requestData = $request->validated();
            $this->companyService->update($companyId, $requestData);
            return redirect()->route('companies.index')->with('success', 'company updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'An error occurred while updating the company');
        }
    }

    public function updatePassword(Request $request, $companyId) {
        try {
            $this->companyService->updatePassword($companyId, $request->password);
            return redirect()->route('companies.index')->with('success', 'company password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'An error occurred while updating the company password');
        }
    }

    public function destroy($id) {  
        try {
            $this->companyService->delete($id);
            return redirect()->route('companies.index')->with('success', 'company deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'An error occurred while deleting the company');
        }
    }
}
