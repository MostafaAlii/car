<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('discounts')->truncate();

        Discount::create([
            'code' => 'a7medFixed',
            'type' => 'fixed',
            'start_data' => Carbon::now(),
            'end_data' =>Carbon::now()->addMonth(),
            'description' => fake()->text,
            'use_coupon' => fake()->randomElement([10, 20, 30, 40]),
            'couponsUsed' => fake()->numberBetween(200, 400),
            'value' =>fake()->numberBetween(1, 20) ,
            'status' => true,
        ]);

        Discount::create([
            'code' => '7fzyCash',
            'type' => 'cash',
            'start_data' => Carbon::now(),
            'end_data' =>Carbon::now()->addMonth(),
            'description' => fake()->text,
            'use_coupon' => fake()->randomElement([10, 20, 30, 40]),
            'couponsUsed' => fake()->numberBetween(200, 400),
            'value' =>fake()->numberBetween(1, 20) ,
            'status' => true,
        ]);

        for ($i = 0; $i <= 20; $i++) {
            Discount::create([
                'code' => fake()->unique()->postcode(),
                'type' => fake()->randomElement(['fixed', 'cash']),
                'start_data' => Carbon::now(),
                'end_data' =>Carbon::now()->addMonth(),
                'description' => fake()->text,
                'use_coupon' => fake()->randomElement([10, 20, 30, 40]),
                'couponsUsed' => fake()->numberBetween(200, 400),
                'value' =>fake()->numberBetween(1, 20) ,
                'status' => true,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
