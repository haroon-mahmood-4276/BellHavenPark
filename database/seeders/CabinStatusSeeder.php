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
                'name' => 'Open',
                'slug' => Str::of('Open')->slug(),
                'description' => 'Open',
            ],
            [
                'name' => 'Closed - Permanent',
                'slug' => Str::of('Closed - Permanent')->slug(),
                'description' => 'Closed - Permanent',
            ],
            [
                'name' => 'Closed - Temporarily',
                'slug' => Str::of('Closed - Temporarily')->slug(),
                'description' => 'Closed - Temporarily',
            ],
        ];

        foreach ($data as $key => $cabinStatus) {
            (new CabinStatus())->create($cabinStatus);
        }
    }
}
