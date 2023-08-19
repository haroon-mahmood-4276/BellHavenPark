<?php

namespace Database\Seeders;

use App\Models\CabinAsset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CabinAssetSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CabinAsset::truncate();
        $data = [
            [
                'name'=> 'TV',
                'slug' => Str::of('TV')->slug(),
                'installable' => true,
                'serviceable' => false,
                'expireable' => false,
            ],
            [
                'name'=> 'Fridge',
                'slug' => Str::of('Fridge')->slug(),
                'installable' => true,
                'serviceable' => false,
                'expireable' => false,
            ],
            [
                'name'=> 'AC',
                'slug' => Str::of('AC')->slug(),
                'installable' => true,
                'serviceable' => true,
                'expireable' => false,
            ],
            [
                'name'=> 'Filters',
                'slug' => Str::of('Filters')->slug(),
                'installable' => true,
                'serviceable' => false,
                'expireable' => true,
            ],
        ];

        foreach ($data as $key => $cabinAsset) {
            (new CabinAsset())->create($cabinAsset);
        }
    }
}
