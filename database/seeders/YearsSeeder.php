<?php

namespace Database\Seeders;

use App\Models\Years;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class YearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('years')->truncate();
        $currentYear = date('Y');
        $startYear = 2000;

        for ($year = $startYear; $year <= $currentYear; $year++) {
            Years::create([
                'name' => $year,

            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
