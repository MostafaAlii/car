<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Section extends Model {
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = ['name', 'admin_id', 'agent_id', 'country_id', 'status'];
    public function scopeActive() {
        return $this->whereStatus('active')->get();
    }

    public function country(): BelongsTo {
        return $this->belongsTo(related:Country::class, foreignKey:'country_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(related:Admin::class, foreignKey:'admin_id');
    }

    public function agent(): BelongsTo {
        return $this->belongsTo(related:Agent::class, foreignKey:'agent_id');
    }
}
