<?php

namespace Database\Seeders;

use App\Models\TripType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('trip_types')->truncate();

       TripType::create([
           'name' => 'Ride',
           'status' => true,
       ]);

       TripType::create([
           'name' => 'Rent',
           'status' => true,
       ]);

       TripType::create([
           'name' => 'Travel',
           'status' => true,
       ]);

        Schema::enableForeignKeyConstraints();
    }
}
