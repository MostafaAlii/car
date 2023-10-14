<?php
namespace App\Services\Dashboard\Companies;
use App\Models\Captain;
class CaptainService {
    public function create($data) {
        $data['password'] = bcrypt($data['password']);
        $data['company_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
        return Captain::create($data);
    }
    
    public function update($captainId, $data) {
        $data['company_id'] = get_user_data()->id;
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

    public function getNotifications($captainId) {
        $captain = Captain::findOrFail($captainId);
        return $captain->notifications;
    }
    
    public function getProfile($captainId) {
        return Captain::with(['profile'])->whereHas('profile', function ($query) use ($captainId) {
            $query->where('uuid', $captainId);
        })->firstOrFail();
    }
}