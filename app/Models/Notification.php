<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'captains_id',
        'notifications_title',
        'notifications_body',
        'admin_id',
        'employee_id',
        'agent_id',
        'company_id',
    ];

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function captains()
    {
        return $this->belongsTo(Captain::class, 'captains_id');
    }
}
