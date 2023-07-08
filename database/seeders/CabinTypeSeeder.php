<?php

namespace Database\Seeders;

use App\Models\CabinType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'slug' => Str::of('Standard Cabin')->slug(),
            ],
            [
                'name' => 'Ensuite Cabin',
                'slug' => Str::of('Ensuite Cabin')->slug(),
            ],
            [
                'name' => 'Caravan',
                'slug' => Str::of('Caravan')->slug(),
            ],
            [
                'name' => 'Caravan & Annex',
                'slug' => Str::of('Caravan & Annex')->slug(),
            ],
            [
                'name' => 'Cutomer Owned',
                'slug' => Str::of('Cutomer Owned')->slug(),
            ],
            [
                'name' => 'Vacant Site',
                'slug' => Str::of('Vacant Site')->slug(),
            ],
            [
                'name' => 'Drive Through',
                'slug' => Str::of('Drive Through')->slug(),
            ],
            [
                'name' => 'Tent Site',
                'slug' => Str::of('Tent Site')->slug(),
            ],
            [
                'name' => 'UnPoweredSites',
                'slug' => Str::of('UnPoweredSites')->slug(),
            ],
            [
                'name' => 'Spare',
                'slug' => Str::of('Spare')->slug(),
            ],
            [
                'name' => 'Ensuite Villa',
                'slug' => Str::of('Ensuite Villa')->slug(),
            ],
            [
                'name' => 'Inv-Sale',
                'slug' => Str::of('Inv-Sale')->slug(),
            ],
        ];

        foreach ($data as $key => $cabinType) {
            (new CabinType())->create($cabinType);
        }
    }
}
