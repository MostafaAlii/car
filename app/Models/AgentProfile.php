<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AgentProfile extends BaseModel {
    protected $table = 'agent_profiles';
    protected $fillable = ['bio','agent_id', 'uuid', 'avatar'];
    public $timestamps = false;
    public function owner(): BelongsTo {
        return $this->belongsTo(related:Agent::class, foreignKey:'agent_id');
    }
}
