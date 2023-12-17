<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            BookingSourceSeeder::class,
            BookingTaxSeeder::class,
            CabinTypeSeeder::class,
            CabinAssetSeeder::class,
            CabinSeeder::class,
            InternationalIdSeeder::class,
            PaymentMethodSeeder::class,
            CustomerSeeder::class,
            CustomerRatingSeeder::class,
            SettingSeeder::class
        ]);
    }
}
