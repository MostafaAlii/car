<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'sections';
    protected $fillable = ['name', 'admin_id', 'agent_id', 'country_id', 'status'];

    public function scopeActive() {
        return $this->whereStatus('active')->get();
    }
}
