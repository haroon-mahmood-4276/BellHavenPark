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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vacant',
                'description' => 'Vacant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Closed',
                'description' => 'Closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $key => $cabinStatus) {
            (new CabinStatus())->create($cabinStatus);
        }
    }
}
