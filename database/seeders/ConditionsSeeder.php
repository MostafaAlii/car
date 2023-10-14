<?php

namespace Database\Seeders;

use App\Models\Conditions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('conditions')->truncate();
        Conditions::create([
            'notes'          =>  fake()->paragraph(),
            'photo'         =>  fake()->imageUrl(),
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
