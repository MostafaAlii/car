<?php
namespace App\Services\Dashboard\General;
use App\Models\Package;
class PackageService {

    public function create($data) {
        if(auth()->guard('admin')->check())
            $data['admin_id'] = get_user_data()->id;
        if(auth()->guard('agent')->check())
            $data['agent_id'] = get_user_data()->id;
        if(auth()->guard('employee')->check())
            $data['employee_id'] = get_user_data()->id;
        if(auth()->guard('company')->check())
            $data['company_id'] = get_user_data()->id;
        return Package::create($data);
    }
    public function update($packageId, $requestData) {
        if(auth()->guard('admin')->check())
            $requestData['admin_id'] = get_user_data()->id;
        if(auth()->guard('agent')->check())
            $requestData['agent_id'] = get_user_data()->id;
        if(auth()->guard('employee')->check())
            $requestData['employee_id'] = get_user_data()->id;
        if(auth()->guard('company')->check())
            $requestData['company_id'] = get_user_data()->id;
        $package = Package::findOrFail($packageId);
        $package->fill($requestData);
        $package->save();
        return $package;
    }

    public function updateStatus($packageId, $status) {
        $package = Package::findOrFail($packageId);
        $package->status = $status;
        $package->save();
        return $package;
    }

    public function delete($packageId) {
        $package = Package::findOrFail($packageId);
        $package->delete();
        return $package;
    }
}