<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('subscriptions')->truncate();

        for ($i = 0; $i < 13; $i++) {
            Subscription::create([
                'name' => fake()->name(),
                'start_data' => Carbon::now(),
                'end_data' => Carbon::now()->addMonth(),
                'price' => fake()->numberBetween([100, 600]),
                'value' => fake()->numberBetween([500, 800]),
                'status' => fake()->randomElement([true, false]),
                'notes' => fake()->paragraph(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
