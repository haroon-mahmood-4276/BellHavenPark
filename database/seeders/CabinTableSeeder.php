<?php

namespace Database\Seeders;

use App\Models\Cabin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Cabin())->insert([
            [
                // 'id' => 1,
                'haven_cabin_type_id' => '1',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 1',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 2,
                'haven_cabin_type_id' => '2',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 2',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 3,
                'haven_cabin_type_id' => '3',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 3',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 4,
                'haven_cabin_type_id' => '4',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 4',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 5,
                'haven_cabin_type_id' => '5',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 5',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 6,
                'haven_cabin_type_id' => '6',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 6',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 7,
                'haven_cabin_type_id' => '7',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 7',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 8,
                'haven_cabin_type_id' => '8',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 8',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 9,
                'haven_cabin_type_id' => '9',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 9',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 10,
                'haven_cabin_type_id' => '10',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 10',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 11,
                'haven_cabin_type_id' => '11',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 11',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 12,
                'haven_cabin_type_id' => '12',
                'haven_cabin_status_id' => '2',
                'name' => 'Cabin 12',
                'long_term' => '1',
                'electric_meter' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
