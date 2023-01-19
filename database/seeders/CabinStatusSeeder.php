<?php

namespace Database\Seeders;

use App\Models\CabinStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabinStatusSeeder extends Seeder
{
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
                'description' => 'Occupied',
            ],
            [
                'name' => 'Vacant',
                'description' => 'Vacant',
            ],
            [
                'name' => 'Closed',
                'description' => 'Closed',
            ],
        ];

        foreach ($data as $key => $cabinStatus) {
            (new CabinStatus())->create($cabinStatus);
        }
    }
}
