<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'employee_id',
        'agent_id',
        'company_id',
        'type',
        'user_id',
        'captain_id',
        'status',
        'amount',
        'payment_date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function captain()
    {
        return $this->belongsTo(Captain::class, 'captain_id');
    }


}
