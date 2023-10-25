<?php
namespace App\Services\Dashboard\General;
use App\Models\State;
class StateService {
    public function updateStatus($stateId, $status) {
        $state = State::findOrFail($stateId);
        $state->status = $status;
        $state->save();
        return $state;
    }
}