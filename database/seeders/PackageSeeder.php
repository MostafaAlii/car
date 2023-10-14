<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('packages')->truncate();

        for ($i = 0; $i < 3; $i++) {
            Package::create([
                'name'=> fake()->name(),
                'status'=> fake()->randomElement([true,false]),
                'notes'=> fake()->paragraph(),
                'price'=> fake()->numberBetween([100,600]),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
