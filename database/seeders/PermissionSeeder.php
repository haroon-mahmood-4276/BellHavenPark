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
        Permission::truncate();
        $data = [

            // Roles Routes
            [
                'name' => 'roles.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Role',
            ],
            [
                'name' => 'roles.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Role',
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Role',
            ],
            [
                'name' => 'roles.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Role',
            ],
            [
                'name' => 'roles.destroy',
                'show_name' => 'Can Destroy Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'roles.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Roles',
            ],

            // Permissions Routes
            [
                'name' => 'permissions.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Permissions',
            ],
            [
                'name' => 'permissions.view_all',
                'guard_name' => 'web',
                'show_name' => 'Can View All Site Roles Permissions',
            ],
            // [
            //     'name' => 'permissions.create',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Create Permissions',
            // ],
            // [
            //     'name' => 'permissions.store',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Store Permissions',
            // ],
            // [
            //     'name' => 'permissions.edit',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Edit Permissions',
            // ],
            // [
            //     'name' => 'permissions.update',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Update Permissions',
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Destroy Permission',
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Destroy Selected Permissions',
            // ],
            [
                'name' => 'permissions.assign-permission',
                'show_name' => 'Can Assign Permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'permissions.revoke-permission',
                'show_name' => 'Can Revoke Permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'permissions.edit-own-permission',
                'show_name' => 'Can Edit Own Permission',
                'guard_name' => 'web',
            ],

            // Sites Routes
            [
                'name' => 'cache.flush',
                'guard_name' => 'web',
                'show_name' => 'Can Refresh Site Cache',
            ],

            // Commands Routes
            [
                'name' => 'commands.command',
                'guard_name' => 'web',
                'show_name' => 'Can Run Artisan Commands',
            ],

            // Payment Method Routes
            [
                'name' => 'payment-methods.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
            ],
            [
                'name' => 'payment-methods.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Role',
            ],
            [
                'name' => 'payment-methods.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Role',
            ],
            [
                'name' => 'payment-methods.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Role',
            ],
            [
                'name' => 'payment-methods.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Role',
            ],
            [
                'name' => 'payment-methods.destroy',
                'show_name' => 'Can Destroy Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'payment-methods.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Roles',
            ],

            // International Ids Routes
            [
                'name' => 'international-ids.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
            ],
            [
                'name' => 'international-ids.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Role',
            ],
            [
                'name' => 'international-ids.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Role',
            ],
            [
                'name' => 'international-ids.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Role',
            ],
            [
                'name' => 'international-ids.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Role',
            ],
            [
                'name' => 'international-ids.destroy',
                'show_name' => 'Can Destroy Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'international-ids.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Roles',
            ],

            // Cabin Types Routes
            [
                'name' => 'cabin-types.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
            ],
            [
                'name' => 'cabin-types.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Role',
            ],
            [
                'name' => 'cabin-types.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Role',
            ],
            [
                'name' => 'cabin-types.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Role',
            ],
            [
                'name' => 'cabin-types.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Role',
            ],
            [
                'name' => 'cabin-types.destroy',
                'show_name' => 'Can Destroy Role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'cabin-types.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Roles',
            ],
        ];

        $role = (new Role())->first();

        foreach ($data as $permission) {
            $permission = (new Permission())->create($permission)->assignRole($role);
        }
    }
}
