<?php
namespace App\Services\Dashboard\Admins;
use App\Models\Company;
class CompanyService {
    public function create($data) {
        $data['password'] = bcrypt($data['password']);
        $data['admin_id'] = get_user_data()->id;
        return Company::create($data);
    }
    
    public function update($companyId, $data) {
        $data['admin_id'] = get_user_data()->id;
        $company = Company::findOrFail($companyId);
        $company->fill($data);
        $company->save();
        return $company;
    }

    public function delete($companyId) {
        $company = Company::findOrFail($companyId);
        $company->delete();
        return $company;
    }

    public function updatePassword($companyId, $password) {
        $company = Company::findOrFail($companyId);
        $company->password = bcrypt($password);
        $company->save();
        return $company;
    }
}