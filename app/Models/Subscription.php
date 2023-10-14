<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_data',
        'end_data',
        'price',
        'value',
        'status',
        'admin_id',
        'employee_id',
        'agent_id',
        'company_id',
    ];

    public function status() {
        return $this->status ? 'Active' : 'No Active';
    }

    public function scopeActive() {
        return $this->whereStatus(true)->get();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
