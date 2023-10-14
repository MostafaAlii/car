<?php
namespace App\Services\Dashboard\Agents;
use App\Models\Company;
class CompanyService {
    public function create($data) {
        $data['password'] = bcrypt($data['password']);
        $data['agent_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
        return Company::create($data);
    }
    
    public function update($companyId, $data) {
        $data['agent_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
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