<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Role)->insert([
            [
                // 'id' => '1',
                'name' => 'Super Admin',
                'created_by_id' => '1',
                'updated_by_id' => '1',
                'deleted_by_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => '2',
                'name' => 'Admin',
                'created_by_id' => '1',
                'updated_by_id' => '1',
                'deleted_by_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
