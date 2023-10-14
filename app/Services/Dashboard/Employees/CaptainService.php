<?php
namespace App\Services\Dashboard\Employees;
use App\Models\Captain;
class CaptainService {
    public function create($data) {
        $data['password'] = bcrypt($data['password']);
        $data['employee_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
        return Captain::create($data);
    }
    
    public function update($captainId, $data) {
        $data['employee_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
        $captain = Captain::findOrFail($captainId);
        $captain->fill($data);
        $captain->save();
        return $captain;
    }

    public function delete($captainId) {
        $captain = Captain::findOrFail($captainId);
        $captain->delete();
        return $captain;
    }

    public function updatePassword($captainId, $password) {
        $captain = Captain::findOrFail($captainId);
        $captain->password = bcrypt($password);
        $captain->save();
        return $captain;
    }
}