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
                'show_name' => 'Can View Payment Methods',
            ],
            [
                'name' => 'payment-methods.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Payment Method',
            ],
            [
                'name' => 'payment-methods.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Payment Method',
            ],
            [
                'name' => 'payment-methods.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Payment Method',
            ],
            [
                'name' => 'payment-methods.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Payment Method',
            ],
            [
                'name' => 'payment-methods.destroy',
                'show_name' => 'Can Destroy Payment Method',
                'guard_name' => 'web',
            ],
            [
                'name' => 'payment-methods.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Payment Methods',
            ],

            // International Ids Routes
            [
                'name' => 'international-ids.index',
                'guard_name' => 'web',
                'show_name' => 'Can View International Ids',
            ],
            [
                'name' => 'international-ids.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create International Id',
            ],
            [
                'name' => 'international-ids.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store International Id',
            ],
            [
                'name' => 'international-ids.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit International Id',
            ],
            [
                'name' => 'international-ids.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update International Id',
            ],
            [
                'name' => 'international-ids.destroy',
                'show_name' => 'Can Destroy International Id',
                'guard_name' => 'web',
            ],
            [
                'name' => 'international-ids.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export International Ids',
            ],

            // Cabin Types Routes
            [
                'name' => 'cabin-types.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Cabin Types',
            ],
            [
                'name' => 'cabin-types.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Cabin Type',
            ],
            [
                'name' => 'cabin-types.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Cabin Type',
            ],
            [
                'name' => 'cabin-types.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Cabin Type',
            ],
            [
                'name' => 'cabin-types.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Cabin Type',
            ],
            [
                'name' => 'cabin-types.destroy',
                'show_name' => 'Can Destroy Cabin Type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'cabin-types.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Cabin Types',
            ],

            // Cabins Routes
            [
                'name' => 'cabins.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Cabins',
            ],
            [
                'name' => 'cabins.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Cabin',
            ],
            [
                'name' => 'cabins.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Cabin',
            ],
            [
                'name' => 'cabins.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Cabin',
            ],
            [
                'name' => 'cabins.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Cabin',
            ],
            [
                'name' => 'cabins.destroy',
                'show_name' => 'Can Destroy Cabin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'cabins.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Cabins',
            ],

            // Booking Sources Routes
            [
                'name' => 'booking-sources.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Booking Sources',
            ],
            [
                'name' => 'booking-sources.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Booking Source',
            ],
            [
                'name' => 'booking-sources.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Booking Source',
            ],
            [
                'name' => 'booking-sources.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Booking Source',
            ],
            [
                'name' => 'booking-sources.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Booking Source',
            ],
            [
                'name' => 'booking-sources.destroy',
                'show_name' => 'Can Destroy Booking Source',
                'guard_name' => 'web',
            ],
            [
                'name' => 'booking-sources.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Booking Sources',
            ],
        ];

        $role = (new Role())->first();

        foreach ($data as $permission) {
            $permission = (new Permission())->create($permission)->assignRole($role);
        }
    }
}
