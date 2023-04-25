<?php

namespace Database\Seeders;

use App\Models\InternationalId;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternationalIdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new InternationalId())->insert([
            [
                // 'id' => '1',
                'name' => 'Licence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '2',
                'name' => 'Passport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '3',
                'name' => 'Rego',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
