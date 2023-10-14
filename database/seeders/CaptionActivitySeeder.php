<?php

namespace Database\Seeders;

use App\Models\Captain;
use App\Models\CaptionActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CaptionActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('caption_activities')->truncate();

        for ($i = 0; $i < 9; $i++) {
            CaptionActivity::create([
                'captain_id'=> $i+1,
                'longitude' =>fake()->unique()->longitude(),
                'latitude'=> fake()->unique()->latitude(),
                'type_captain'=> fake()->randomElement(['active','inorder']),
                'status_captain' => fake()->randomElement(['active','inactive']),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
