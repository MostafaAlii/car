<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'name',
        'number',
        'status'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function scopeActive()
    {
        return $this->whereStatus('active')->get();
    }
}
