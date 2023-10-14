<?php
declare (strict_types = 1);
namespace App\Observers;
use App\Models\Agent;
class AgentObserver {
    public function created(Agent $agent): void {
        $agent->profile()->create([]);
    }
}