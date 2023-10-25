<?php
namespace App\Http\Controllers\Dashboard\General;
use App\DataTables\Dashboard\General\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\General\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller {
    public function __construct(protected CountryDataTable $countryDataTable, protected CountryService $countryService) {
        $this->countryDataTable = $countryDataTable;
        $this->countryService = $countryService;
    }

    public function index() {
        return $this->countryDataTable->render('dashboard.general.countries.index', ['title' => 'Countries']);
    }

    public function changeStatusCountry(Request $request, $countryId) {
        try {
            $this->countryService->updateStatus($countryId, $request->status);
            return redirect()->route('countries.index')->with('success', 'Country Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('countries.index')->with('error', 'An error occurred while updating the Country Status');
        }
    }

    
}