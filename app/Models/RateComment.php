<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'admin_id',
        'employee_id',
        'agent_id',
        'company_id',
        'user_id',
        'captain_id',
        'rate',
        'comment',
        'type',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function captain()
    {
        return $this->belongsTo(Captain::class, 'captain_id');
    }
}
