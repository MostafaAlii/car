<?php

namespace App\Http\Controllers\Dashboard\General;

use App\DataTables\Dashboard\General\CityDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\General\CityService;

class CityController extends Controller {
    public function __construct(protected CityDataTable $cityDataTable, protected CityService $cityService) {
        $this->cityDataTable = $cityDataTable;
        $this->cityService = $cityService;
    }

    public function index() {
        return $this->cityDataTable->render('dashboard.general.cities.index', ['title' => 'Cities']);
    }

    public function changeStatusCity(Request $request, $cityId) {
        try {
            $this->cityService->updateStatus($cityId, $request->status);
            return redirect()->route('cities.index')->with('success', 'City Status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with('error', 'An error occurred while updating the City Status');
        }
    }

}