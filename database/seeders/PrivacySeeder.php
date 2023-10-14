<?php

namespace Database\Seeders;

use App\Models\Privacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('privacies')->truncate();
        Privacy::create([
            'notes'          =>  fake()->paragraph(),
            'photo'         =>  fake()->imageUrl(),
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
