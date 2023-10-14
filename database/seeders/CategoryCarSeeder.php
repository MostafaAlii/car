<?php

namespace Database\Seeders;

use App\Models\CategoryCar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoryCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('category_cars')->truncate();

        CategoryCar::create([
            'name' => 'A+',
            'status' => true,
        ]);

        CategoryCar::create([
            'name' => 'A',
            'status' => true,
        ]);

        CategoryCar::create([
            'name' => 'B',
            'status' => true,
        ]);

        CategoryCar::create([
            'name' => 'C',
            'status' => true,
        ]);



        Schema::enableForeignKeyConstraints();
    }
}
