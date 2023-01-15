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
                'rate' => 0,
            ],
            [
                'name' => 'Ensuite Cabin',
                'rate' => 0,
            ],
            [
                'name' => 'Caravan',
                'rate' => 0,
            ],
            [
                'name' => 'Caravan & Annex',
                'rate' => 0,
            ],
            [
                'name' => 'Cutomer Owned',
                'rate' => 0,
            ],
            [
                'name' => 'Vacant Site',
                'rate' => 0,
            ],
            [
                'name' => 'Drive Through',
                'rate' => 0,
            ],
            [
                'name' => 'Tent Site',
                'rate' => 0,
            ],
            [
                'name' => 'UnPoweredSites',
                'rate' => 0,
            ],
            [
                'name' => 'Spare',
                'rate' => 0,
            ],
            [
                'name' => 'Ensuite Villa',
                'rate' => 0,
            ],
            [
                'name' => 'Inv-Sale',
                'rate' => 0,
            ],
        ];

        foreach ($data as $key => $cabinType) {
            (new CabinType())->create($cabinType);
        }
    }
}
