<?php
namespace App\Services\Dashboard\Admins;
use App\Models\User;
class UserService {
    public function createAdmin($data) {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function updateAdmin($adminId, $data) {
        $admin = User::findOrFail($adminId);
        $admin->fill($data);
        $admin->save();
        return $admin;
    }

    public function deleteAdmin($adminId) {
        $admin = User::findOrFail($adminId);
        $admin->delete();
        return $admin;
    }

    public function updatePassword($adminId, $password) {
        $admin = User::findOrFail($adminId);
        $admin->password = bcrypt($password);
        $admin->save();
        return $admin;
    }

    public function getProfile($userId) {
        $relations = [
            'profile',
        ];
        return User::with($relations)->whereHas('profile', function ($query) use ($userId) {
            $query->where('uuid', $userId);
        })->firstOrFail();
    }
}