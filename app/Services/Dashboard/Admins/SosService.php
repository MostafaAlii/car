<?php
namespace App\Services\Dashboard\Admins;
use App\Models\Sos;
class SosService {
    public function create($data) {
        $data['admin_id'] = get_user_data()->id;
        return Sos::create($data);
    }
    
    public function update($sosId, $data) {
        $data['admin_id'] = get_user_data()->id;
        $sos = Sos::findOrFail($sosId);
        $sos->fill($data);
        $sos->save();
        return $sos;
    }

    public function delete($sosId) {
        $sos = Sos::findOrFail($sosId);
        $sos->delete();
        return $sos;
    }

    public function updateStatus($sosId, $status) {
        $sos = Sos::findOrFail($sosId);
        $sos->status = $status;
        $sos->save();
        return $sos;
    }
}