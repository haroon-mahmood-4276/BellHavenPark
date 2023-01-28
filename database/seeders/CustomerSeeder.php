<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\InternationalId;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $internationalId = (new InternationalId())->first();

        $data = [
            [
                "first_name" => 'Haroon',
                "last_name" => 'Mahmood',
                "address" => 'Lahore',
                "email" => 'haroon@customer.com',
                "phone" => '999 999 9999',
                "dob" => Carbon::parse('1999-06-09')->timestamp,
                "telephone" => '999 999 9999',
                "international_id_id" => $internationalId->id,
                "international_details" => '999 999 9999',
                "international_address" => '999 999 9999',
                "comments" => 'asdasdasdasdasdasd',
            ],
            [
                "first_name" => 'Nasir',
                "last_name" => 'Mahmood',
                "address" => 'Lahore',
                "email" => 'haroon@customer.com',
                "phone" => '999 999 9999',
                "dob" => Carbon::parse('1999-06-09')->timestamp,
                "telephone" => '999 999 9999',
                "international_id_id" => $internationalId->id,
                "international_details" => '999 999 9999',
                "international_address" => '999 999 9999',
                "comments" => 'asdasdasdasdasdasd',
            ],
            [
                "first_name" => 'Kamran',
                "last_name" => 'Mahmood',
                "address" => 'Lahore',
                "email" => 'haroon@customer.com',
                "phone" => '999 999 9999',
                "dob" => Carbon::parse('1999-06-09')->timestamp,
                "telephone" => '999 999 9999',
                "international_id_id" => $internationalId->id,
                "international_details" => '999 999 9999',
                "international_address" => '999 999 9999',
                "comments" => 'asdasdasdasdasdasd',
            ],
        ];

        foreach ($data as $key => $customers) {
            (new Customer())->create($customers);
        }
    }
}
