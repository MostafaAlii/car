<?php

namespace App\Http\Controllers\Dashboard\General;

use App\DataTables\Dashboard\General\DiscountDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\General\DiscountService;

class DiscountController extends Controller {
    public function __construct(protected DiscountDataTable $discountDataTable, protected DiscountService $discountService) {
        $this->discountDataTable = $discountDataTable;
        $this->discountService = $discountService;
    }

    public function index() {
        return $this->discountDataTable->render('dashboard.general.discount.index', ['title' => 'Discount']);
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->all();
            $this->discountService->create($validatedData);
            return redirect()->route('discounts.index')->with('success', 'discount created successfully');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')->with('error', 'An error occurred while creating the discount');
        }
    }

    public function update(Request $request, $discountId) {
        try {
            $requestData = $request->all();
            $this->discountService->update($discountId, $requestData);
            return redirect()->route('discounts.index')->with('success', 'discount updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')->with('error', 'An error occurred while updating the discount');
        }
    }

    public function updateStatus(Request $request, $discountId) {
        try {
            $this->discountService->updateStatus($discountId, $request->status);
            return redirect()->route('discounts.index')->with('success', 'discount status updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')->with('error', 'An error occurred while updating the discount');
        }
    }

    public function destroy($id) {  
        try {
            $this->discountService->delete($id);
            return redirect()->route('discounts.index')->with('success', 'discount deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('discounts.index')->with('error', 'An error occurred while deleting the discount');
        }
    }

}