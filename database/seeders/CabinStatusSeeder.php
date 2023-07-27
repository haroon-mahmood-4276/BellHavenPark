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
                'name' => 'Closed - Permanent',
                'slug' => Str::of('Closed - Permanent')->slug(),
                'description' => 'Closed - Permanent',
            ],
            [
                'name' => 'Closed - Temporarly',
                'slug' => Str::of('Closed - Temporarly')->slug(),
                'description' => 'Closed - Temporarly',
            ],
        ];

        foreach ($data as $key => $cabinStatus) {
            (new CabinStatus())->create($cabinStatus);
        }
    }
}
