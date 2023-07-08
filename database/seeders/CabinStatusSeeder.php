<?php

namespace Database\Seeders;

use App\Models\CabinStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CabinStatusSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CabinStatus::truncate();
        $data = [
            [
                'name' => 'Occupied',
                'slug' => Str::of('Occupied')->slug(),
                'description' => 'Occupied',
            ],
            [
                'name' => 'Vacant',
                'slug' => Str::of('Vacant')->slug(),
                'description' => 'Vacant',
            ],
            [
                'name' => 'Closed',
                'slug' => Str::of('Closed')->slug(),
                'description' => 'Closed',
            ],
        ];

        foreach ($data as $key => $cabinStatus) {
            (new CabinStatus())->create($cabinStatus);
        }
    }
}
