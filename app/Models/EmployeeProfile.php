<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class EmployeeProfile extends BaseModel {
    protected $table = 'employee_profiles';
    protected $fillable = ['name','bio','employee_id', 'uuid', 'avatar'];

    public function owner(): BelongsTo {
        return $this->belongsTo(related:Employee::class, foreignKey:'employee_id');
    }
}
