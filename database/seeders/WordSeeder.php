<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB,Schema};

class WordSeeder extends Seeder {
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('countries')->truncate();
        DB::table('states')->truncate();
        DB::table('cities')->truncate();
        
        $file_path = public_path('word.sql');


        DB::unprepared(
            file_get_contents($file_path)
        );
        Schema::enableForeignKeyConstraints();

    }
}
