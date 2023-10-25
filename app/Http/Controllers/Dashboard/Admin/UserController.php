<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\DataTables\Orders\OrderDataTable;
use App\DataTables\Dashboard\Admin\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\UserRequestValidation;
use App\Services\Dashboard\Admins\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UsersDataTable $dataTable, protected UserService $adminService)
    {
        $this->dataTable = $dataTable;
        $this->adminService = $adminService;
    }

    public function index()
    {
        return $this->dataTable->render('dashboard.admin.users.index', ['title' => 'users']);
    }

    public function store(UserRequestValidation $request)
    {
        try {
            $requestData = $request->validated();
            $this->adminService->createAdmin($requestData);
            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'An error occurred while creating the admin');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $admin = $this->adminService->updateAdmin($id, $validatedData);
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating');
        }
    }

    public function updatePassword(Request $request, $adminId)
    {
        try {
            $this->adminService->updatePassword($adminId, $request->password);
            return redirect()->route('users.index')->with('success', 'User password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'An error occurred while updating the User password');
        }
    }

    public function destroy($id)
    {
        try {
            $this->adminService->deleteAdmin($id);
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'An error occurred while deleting the admin');
        }
    }

    public function sendNotificationAll(Request $request)
    {
        try {
            sendNotificatioAll($request->type, $request->body, $request->title);
            return redirect()->route('users.index')->with('success', 'Successfully Send Notifications');

        } catch (\Exception $exception) {
            return redirect()->route('users.index')->with('error', 'An error occurred');

        }
    }

    public function sendNotification(Request $request)
    {
        try {
            sendNotificationUser($request->fcm_token_user,$request->body, $request->title);
            return redirect()->route('users.index')->with('success', 'Successfully Send Notifications');

        } catch (\Exception $exception) {
            return redirect()->route('users.index')->with('error', 'An error occurred');

        }
    }

    public function show($userId) {
        try {
            $data = [
                'title' => 'User Details',
                'user' => $this->adminService->getProfile($userId),
            ];
            return view('dashboard.admin.users.show', compact('data'));
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'An error occurred while getting the user details');
        }
    }

    public function getOrders(OrderDataTable $dataTable) {
        return $dataTable->render('dashboard.admin.captains.Orders.orders',['client_orders' => \request()->client_orders]);
    }
}
