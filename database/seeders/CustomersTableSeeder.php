<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Customer())->insert([
            [
                // 'id' => 1,
                "first_name" => 'Haroon',
                "last_name" => 'Mahmood',
                "address" => 'Lahore',
                "email" => 'haroon@customer.com',
                "phone" => '999 999 9999',
                "dob" => '1999-06-09',
                "telephone" => '999 999 9999',
                "haven_international_id_id" => '1',
                "haven_international_id_details" => '999 999 9999',
                "haven_international_id_address" => '999 999 9999',
                "comments" => 'asdasdasdasdasdasd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 2,
                "first_name" => 'Nasir',
                "last_name" => 'Mahmood',
                "address" => 'Lahore',
                "email" => 'haroon@customer.com',
                "phone" => '999 999 9999',
                "dob" => '1999-06-09',
                "telephone" => '999 999 9999',
                "haven_international_id_id" => '1',
                "haven_international_id_details" => '999 999 9999',
                "haven_international_id_address" => '999 999 9999',
                "comments" => 'asdasdasdasdasdasd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 3,
                "first_name" => 'Kamran',
                "last_name" => 'Mahmood',
                "address" => 'Lahore',
                "email" => 'haroon@customer.com',
                "phone" => '999 999 9999',
                "dob" => '1999-06-09',
                "telephone" => '999 999 9999',
                "haven_international_id_id" => '1',
                "haven_international_id_details" => '999 999 9999',
                "haven_international_id_address" => '999 999 9999',
                "comments" => 'asdasdasdasdasdasd',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
