<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Admins\AdminService;
use App\DataTables\Dashboard\Admin\AdminDataTable;
use App\Http\Requests\Dashboard\Admin\AdminRequestValidation;

class AdminController extends Controller {
    public function __construct(protected AdminDataTable $dataTable, protected AdminService $adminService) {
        $this->dataTable = $dataTable;
        $this->adminService = $adminService;
    }
    public function index() {
        return $this->dataTable->render('dashboard.admin.admins.index', ['title' => 'Admins']);
    }

    public function store(AdminRequestValidation $request) {
        try {
            $requestData = $request->validated();
            $this->adminService->createAdmin($requestData);
            return redirect()->route('admins.index')->with('success', 'Admin created successfully');
        } catch (\Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An error occurred while creating the admin');
        }
    }

    public function update(AdminRequestValidation $request, $id) {
        try {
            $validatedData = $request->validated();
            $admin = $this->adminService->updateAdmin($id, $validatedData);
            return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the ' . $admin?->name);
        }
    }

    public function updatePassword(Request $request, $adminId) {
        try {
            $this->adminService->updatePassword($adminId, $request->password);
            return redirect()->route('admins.index')->with('success', 'Admin password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An error occurred while updating the Admin password');
        }
    }

    public function destroy($id) {  
        try {
            $this->adminService->deleteAdmin($id);
            return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admins.index')->with('error', 'An error occurred while deleting the admin');
        }
    }
}