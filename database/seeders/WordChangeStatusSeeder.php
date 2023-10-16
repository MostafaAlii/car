<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordChangeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $countyArray = ['Egypt', 'Iraq', 'Saudi Arabia', 'Algeria'];
        $codes = [20, 964, 966, 213];
        $logos = ['assets/images/Eg.png','assets/images/Iraq.png','assets/images/SaudiArabia.png', 'assets/images/Algeria.png'];
        foreach ($countyArray as $index => $countryName) {
            $code = $codes[$index];
            $logo = $logos[$index];

            Country::where('name', $countryName)
                ->whereHas('states')
                ->update(['status' => true, 'code' => $code, 'logo' => $logo]);
        }


        State::join('countries', 'states.country_id', '=', 'countries.id')
            ->where('countries.status', 1)
            ->whereHas('cities')
            ->update(['states.status' => true]);

        City::join('states', 'cities.state_id', '=', 'states.id')
            ->where('states.status', 1)
            ->update(['cities.status' => true]);

        $now = now();

        Country::query()->update([
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        State::query()->update([
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        City::query()->update([
            'created_at' => $now,
            'updated_at' => $now,
        ]);


    }
}
