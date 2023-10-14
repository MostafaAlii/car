<?php

namespace Database\Seeders;

use App\Models\Sos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('sos')->truncate();
        for ($i = 0; $i < 5; $i++) {
            Sos::create([
                'admin_id' => 1,
                'name' => fake()->name(),
                'number' => fake()->phoneNumber(),
                'status' => fake()->randomElement(['active', 'inactive'])
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
