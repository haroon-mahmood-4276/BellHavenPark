<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Role, Permission};

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            // Roles Routes
            [
                'name' => 'roles.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.destroy',
                'show_name' => 'Can Destroy Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'roles.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Roles',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Permissions Routes
            [
                'name' => 'permissions.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permissions.view_all',
                'guard_name' => 'web',
                'show_name' => 'Can View All Site Roles Permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'permissions.create',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Create Permissions',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'permissions.store',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Store Permissions',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'permissions.edit',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Edit Permissions',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'permissions.update',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Update Permissions',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Destroy Permission',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Destroy Selected Permissions',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'name' => 'permissions.assign-permission',
                'show_name' => 'Can Assign Permission',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permissions.revoke-permission',
                'show_name' => 'Can Revoke Permission',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'permissions.edit-own-permission',
                'show_name' => 'Can Edit Own Permission',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sites Routes
            [
                'name' => 'cache.flush',
                'guard_name' => 'web',
                'show_name' => 'Can Refresh Site Cache',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Commands Routes
            [
                'name' => 'commands.command',
                'guard_name' => 'web',
                'show_name' => 'Can Run Artisan Commands',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Payment Method Routes
            [
                'name' => 'payment-methods.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payment-methods.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payment-methods.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payment-methods.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payment-methods.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payment-methods.destroy',
                'show_name' => 'Can Destroy Role',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'payment-methods.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Roles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $role = (new Role())->first();

        foreach ($data as $key => $value) {
            $permission = (new Permission())->create($value)->assignRole($role);
        }
    }
}
