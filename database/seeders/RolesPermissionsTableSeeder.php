<?php

namespace Database\Seeders;

use App\Models\RolesPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ( new RolesPermission() )->insert( [
            [
                // 'id' => 1,
                'haven_role_id' => 1,
                'haven_permission_id' => 1,
                'view' => 1,
                'store' => 1,
                'update' => 1,
                'destroy' => 1,
                'all' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 2,
                'haven_role_id' => 1,
                'haven_permission_id' => 2,
                'view' => 1,
                'store' => 1,
                'update' => 1,
                'destroy' => 1,
                'all' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 3,
                'haven_role_id' => 1,
                'haven_permission_id' => 3,
                'view' => 1,
                'store' => 1,
                'update' => 1,
                'destroy' => 1,
                'all' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ] );
        ( new RolesPermission() )->insert( [
            [
                'haven_role_id' => 2,
                'haven_permission_id' => 1,
                'view' => 1,
                'store' => 1,
                'update' => 1,
                'destroy' => 1,
                'all' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'haven_role_id' => 2,
                'haven_permission_id' => 2,
                'view' => 1,
                'store' => 1,
                'update' => 1,
                'destroy' => 1,
                'all' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'haven_role_id' => 2,
                'haven_permission_id' => 3,
                'view' => 1,
                'store' => 1,
                'update' => 1,
                'destroy' => 1,
                'all' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ] );
    }
}
