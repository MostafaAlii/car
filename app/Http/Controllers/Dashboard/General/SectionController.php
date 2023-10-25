<?php

namespace App\Http\Controllers\Dashboard\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\{General\SectionService, General\GeneralService};
use App\DataTables\Dashboard\General\SectionDataTable;
use App\Http\Requests\Dashboard\Admin\SectionRequestValidation;
class SectionController extends Controller
{
    public function __construct(protected SectionDataTable $dataTable, protected SectionService $sectionService, protected GeneralService $generalService) {
        $this->dataTable = $dataTable;
        $this->sectionService = $sectionService;
        $this->generalService = $generalService;
    }
    
    public function index() {
        $countries = $this->generalService->getCountries();
        return $this->dataTable->render('dashboard.general.sections.index',  ['title' => 'Sections', 'countries' => $countries]);
    }

    public function store(SectionRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->sectionService->create($requestData);
            return redirect()->route('sections.index')->with('success', 'section created successfully');
        } catch (\Exception $e) {
            return redirect()->route('sections.index')->with('error', 'An error occurred while creating the section');
        }
    }

    public function update(SectionRequestValidation $request, $sectionId) {
        try {
            $requestData = $request->validated();
            $this->sectionService->update($sectionId, $requestData);
            return redirect()->route('sections.index')->with('success', 'car section updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('sections.index')->with('error', 'An error occurred while updating the section');
        }
    }

    public function updateStatus(Request $request, $sectionId) {
        try {
            $this->sectionService->updateStatus($sectionId, $request->status);
            return redirect()->route('sections.index')->with('success', 'section status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('sections.index')->with('error', 'An error occurred while updating the section');
        }
    }

    public function destroy($id) {  
        try {
            $this->sectionService->delete($id);
            return redirect()->route('sections.index')->with('success', 'section deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('sections.index')->with('error', 'An error occurred while deleting the section');
        }
    }
}
