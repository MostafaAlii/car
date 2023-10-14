<?php

namespace Database\Seeders;

use App\Models\CompanySupport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompanySupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('company_supports')->truncate();
        for ($i = 0; $i < 5; $i++) {
            CompanySupport::create([
                'admin_id' => 1,
                'name' => fake()->name(),
                'number' => fake()->phoneNumber(),
                'status' => fake()->randomElement(['active', 'inactive'])
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
