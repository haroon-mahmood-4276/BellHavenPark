<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $AdminRole = (new Role())->create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'parent_id' => null,
        ]);

        $data = [
            [
                'name' => 'Users',
                'guard_name' => 'web',
                'parent_id' => $AdminRole->id,
            ],
        ];

        foreach ($data as $key => $value) {
            (new Role())->create($value);
        }
    }
}
