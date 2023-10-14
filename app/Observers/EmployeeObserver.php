<?php
declare (strict_types = 1);
namespace App\Observers;
use App\Models\Employee;
class EmployeeObserver {
    public function created(Employee $employee): void {
        $employee->profile()->create([]);
    }
}