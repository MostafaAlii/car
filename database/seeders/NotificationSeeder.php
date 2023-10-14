<?php

namespace Database\Seeders;

use App\Models\Captain;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('notifications')->truncate();

        for ($i = 0; $i <= 20; $i++) {
            Notification::create([
                'type' => 'user',
                'user_id' => User::all()->random()->id,
                'captains_id' => null,
                'notifications' => fake()->paragraph(),
            ]);
        }

        for ($i = 0; $i <= 20; $i++) {
            Notification::create([
                'type' => 'driver',
                'user_id' => null,
                'captains_id' => Captain::all()->random()->id,
                'notifications' => fake()->paragraph(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
