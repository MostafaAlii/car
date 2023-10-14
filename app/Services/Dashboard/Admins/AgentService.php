<?php
namespace App\Services\Dashboard\Admins;
use App\Models\Agent;
class AgentService {
    public function createAgent($data) {
        $data['password'] = bcrypt($data['password']);
        $data['admin_id'] = get_user_data()->id;
        return Agent::create($data);
    }
    
    public function updateAgent($agentId, $data) {
        $data['admin_id'] = get_user_data()->id;
        $agent = Agent::findOrFail($agentId);
        $agent->fill($data);
        $agent->save();
        return $agent;
    }

    public function deleteAgent($agentId) {
        $agent = Agent::findOrFail($agentId);
        $agent->delete();
        return $agent;
    }

    public function updatePassword($agentId, $password) {
        $agent = Agent::findOrFail($agentId);
        $agent->password = bcrypt($password);
        $agent->save();
        return $agent;
    }
}