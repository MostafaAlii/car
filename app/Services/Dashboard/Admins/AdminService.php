<?php
namespace App\Services\Dashboard\Admins;
use App\Models\Admin;
class AdminService {
    public function createAdmin($data) {
        $data['password'] = bcrypt($data['password']);
        return Admin::create($data);
    }
    
    public function updateAdmin($adminId, $data) {
        $admin = Admin::findOrFail($adminId);
        $admin->fill($data);
        $admin->save();
        return $admin;
    }

    public function deleteAdmin($adminId) {
        $admin = Admin::findOrFail($adminId);
        $admin->delete();
        return $admin;
    }

    public function updatePassword($adminId, $password) {
        $admin = Admin::findOrFail($adminId);
        $admin->password = bcrypt($password);
        $admin->save();
        return $admin;
    }
}