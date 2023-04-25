<?php

namespace Database\Seeders;

use App\Models\CabinStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabinStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new CabinStatus())->insert([
            [
                // 'id' => '1',
                'name' => 'Occupied',
                'description' => 'Occupied',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '2',
                'name' => 'Vacant',
                'description' => 'Vacant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '3',
                'name' => 'Closed',
                'description' => 'Closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
