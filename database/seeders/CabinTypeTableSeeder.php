<?php

namespace Database\Seeders;

use App\Models\CabinType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabinTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ( new CabinType() )->insert([
            [
                // 'id' => '1',
                'name' => 'Standard Cabin',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '2',
                'name' => 'Ensuite Cabin',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '3',
                'name' => 'Caravan',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '4',
                'name' => 'Caravan & Annex',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '5',
                'name' => 'Cutomer Owned',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '6',
                'name' => 'Vacant Site',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '7',
                'name' => 'Drive Through',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '8',
                'name' => 'Tent Site',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '9',
                'name' => 'UnPoweredSites',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '10',
                'name' => 'Spare',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '11',
                'name' => 'Ensuite Villa',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '12',
                'name' => 'Inv-Sale',
                'rate' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
