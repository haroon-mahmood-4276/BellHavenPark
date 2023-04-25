<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            SettingsTableSeeder::class,
            UserTableSeeder::class,
            InternationalIdTableSeeder::class,
            CustomersTableSeeder::class,
            CabinTypeTableSeeder::class,
            CabinStatusTableSeeder::class,
            CabinTableSeeder::class,
            BookingSourceTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesPermissionsTableSeeder::class,
            PaymentMethodTableSeeder::class,
        ]);
    }
}
