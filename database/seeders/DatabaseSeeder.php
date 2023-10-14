<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        Settings::updateOrCreate(['id' => 1, 'facebook' => fake()->url(),
            'instagram' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'whatsapp' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'version' => 1,
            'open_door' => 3.5,
            'waiting_price' => 2,
            'country_tax' => 10,
            'kilo_price' => 5,
            'api_secret_key' => fake()->name(),
            'ocean' => 2,
            'company_commission' => 5,
            'company_tax' => 6,
        ]);

        $this->call([
            WordSeeder::class,
            WordChangeStatusSeeder::class,
            AdminTableSeeder::class,
            AgentTableSeeder::class,
            SectionTableSeeder::class,
            UserTableSeeder::class,
            CompaniesTableSeeder::class,
            EmployeeTableSeeder::class,
            CaptainTableSeeder::class,
            CarMakeAndModelSeeder::class,
            TripTypeSeeder::class,
            CarTypeSeeder::class,
            CategoryCarSeeder::class,
            DiscountSeeder::class,
            SosSeeder::class,
            PackageSeeder::class,
            OfferSeeder::class,
            CaptionActivitySeeder::class,
            YearsSeeder::class,
            CompanySupportSeeder::class,
            SubscriptionSeeder::class,
            AboutUsSeeder::class,
            ConditionsSeeder::class,
            PrivacySeeder::class,
        ]);
    }
}
