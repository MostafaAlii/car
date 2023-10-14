<?php
namespace App\Services\Dashboard\Agents;
use App\Models\Employee;
class EmployeeService {
    public function create($data) {
        $data['password'] = bcrypt($data['password']);
        $data['admin_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
        return Employee::create($data);
    }
    
    public function update($employeeId, $data) {
        $data['admin_id'] = get_user_data()->id;
        $data['country_id'] = get_user_data()->country_id;
        $employee = Employee::findOrFail($employeeId);
        $employee->fill($data);
        $employee->save();
        return $employee;
    }

    public function delete($employeeId) {
        $employee = Employee::findOrFail($employeeId);
        $employee->delete();
        return $employee;
    }

    public function updatePassword($employeeId, $password) {
        $employee = Employee::findOrFail($employeeId);
        $employee->password = bcrypt($password);
        $employee->save();
        return $employee;
    }
}