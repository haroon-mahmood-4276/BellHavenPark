<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $AdminRole = (new Role())->create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $data = [
            [
                'name' => 'Users',
                'guard_name' => 'web',
                'parent_id' => $AdminRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $key => $value) {
            (new Role())->create($value);
        }
    }
}
