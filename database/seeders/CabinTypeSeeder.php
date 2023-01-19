<?php

namespace Database\Seeders;

use App\Models\CabinType;
use Illuminate\Database\Seeder;

class CabinTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CabinType::truncate();
        $data = [
            [
                'name' => 'Standard Cabin',
                // 'rate' => 1,
            ],
            [
                'name' => 'Ensuite Cabin',
                // 'rate' => 1,
            ],
            [
                'name' => 'Caravan',
                // 'rate' => 1,
            ],
            [
                'name' => 'Caravan & Annex',
                // 'rate' => 1,
            ],
            [
                'name' => 'Cutomer Owned',
                // 'rate' => 1,
            ],
            [
                'name' => 'Vacant Site',
                // 'rate' => 1,
            ],
            [
                'name' => 'Drive Through',
                // 'rate' => 1,
            ],
            [
                'name' => 'Tent Site',
                // 'rate' => 1,
            ],
            [
                'name' => 'UnPoweredSites',
                // 'rate' => 1,
            ],
            [
                'name' => 'Spare',
                // 'rate' => 1,
            ],
            [
                'name' => 'Ensuite Villa',
                // 'rate' => 1,
            ],
            [
                'name' => 'Inv-Sale',
                // 'rate' => 1,
            ],
        ];

        foreach ($data as $key => $cabinType) {
            (new CabinType())->create($cabinType);
        }
    }
}
