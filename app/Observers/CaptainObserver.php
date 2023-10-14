<?php
declare (strict_types = 1);
namespace App\Observers;
use App\Models\Captain;

class CaptainObserver {
    public function created(Captain $captain): void {
        $captain->profile()->create([]);
        $captain->car()->create([]);
//        $captain->captainActivity()->create(['status_captain_work' => 'waiting']);
    }
}
