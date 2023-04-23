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
                'guard_name' => 'web',
                'show_name' => 'Can Delete Role',
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
            //     'show_name' => 'Can Delete Permission',
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Delete Selected Permissions',
            // ],
            [
                'name' => 'permissions.assign-permission',
                'guard_name' => 'web',
                'show_name' => 'Can Assign Permission',
            ],
            [
                'name' => 'permissions.revoke-permission',
                'guard_name' => 'web',
                'show_name' => 'Can Revoke Permission',
            ],
            [
                'name' => 'permissions.edit-own-permission',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Own Permission',
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
                'guard_name' => 'web',
                'show_name' => 'Can Delete Payment Method',
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
                'guard_name' => 'web',
                'show_name' => 'Can Delete International Id',
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
                'guard_name' => 'web',
                'show_name' => 'Can Delete Cabin Type',
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
                'guard_name' => 'web',
                'show_name' => 'Can Delete Cabin',
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
                'guard_name' => 'web',
                'show_name' => 'Can Delete Booking Source',
            ],
            [
                'name' => 'booking-sources.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Booking Sources',
            ],

            // Customers Routes
            [
                'name' => 'customers.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Customers',
            ],
            [
                'name' => 'customers.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Customer',
            ],
            [
                'name' => 'customers.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Customer',
            ],
            [
                'name' => 'customers.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Customer',
            ],
            [
                'name' => 'customers.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Customer',
            ],
            [
                'name' => 'customers.destroy',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Customer',
            ],
            [
                'name' => 'customers.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Customers',
            ],

            // Bookings Routes
            [
                'name' => 'bookings.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Bookings',
            ],
            [
                'name' => 'bookings.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Booking',
            ],
            [
                'name' => 'bookings.checkin.index',
                'show_name' => 'Can View Checkin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bookings.checkout.index',
                'show_name' => 'Can View Checkout',
                'guard_name' => 'web',
            ],

            // Booking Payments Routes
            [
                'name' => 'bookings.payments.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Bookings Payment List',
            ],
            [
                'name' => 'bookings.payments.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Booking Payment',
            ],
            [
                'name' => 'bookings.payments.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Payment',
            ],
            [
                'name' => 'bookings.payments.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Payment',
            ],
            [
                'name' => 'bookings.payments.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Payment',
            ],
            [
                'name' => 'bookings.payments.destroy',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Payment',
            ],
            [
                'name' => 'bookings.payments.export',
                'guard_name' => 'web',
                'show_name' => 'Can Export Payments',
            ],
        ];

        $role = (new Role())->first();

        foreach ($data as $permission) {
            $permission = (new Permission())->create($permission)->assignRole($role);
        }
    }
}
