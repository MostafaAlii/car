<?php

namespace Database\Seeders;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('offers')->truncate();

        for ($i = 0; $i < 13; $i++) {
            Offer::create([
                'name'=> fake()->name(),
                'start_data'=> Carbon::now(),
                'end_data'=> Carbon::now()->addDays(5),
                'status'=> fake()->randomElement([true,false]),
                'notes'=> fake()->paragraph(),
                'value'=> fake()->numberBetween(1, 20),
                'price_to'=> fake()->numberBetween(500, 800),
                'price'=> fake()->numberBetween(100, 600),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
