<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Role, Permission};
use Illuminate\Support\Facades\Artisan;

class PermissionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Permission::truncate();

        Artisan::call('cache:clear');

        $data = [

            // Roles Routes
            [
                'name' => 'roles.index',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can View',
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can Create',
            ],
            [
                'name' => 'roles.store',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can Store',
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can Edit',
            ],
            [
                'name' => 'roles.update',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can Update',
            ],
            [
                'name' => 'roles.destroy',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can Delete',
            ],
            [
                'name' => 'roles.export',
                'guard_name' => 'web',
                'show_name' => 'Roles - Can Export',
            ],

            // Permissions Routes
            [
                'name' => 'permissions.index',
                'guard_name' => 'web',
                'show_name' => 'Permissions - Can View',
            ],
            // [
            //     'name' => 'permissions.view_all',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can View All Site Roles Permissions',
            // ],
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
                'show_name' => 'Permissions - Can Assign',
            ],
            [
                'name' => 'permissions.revoke-permission',
                'guard_name' => 'web',
                'show_name' => 'Permissions - Can Revoke',
            ],
            [
                'name' => 'permissions.edit-own-permission',
                'guard_name' => 'web',
                'show_name' => 'Permissions - Can Edit Own',
            ],

            // Sites Routes
            [
                'name' => 'cache.flush',
                'guard_name' => 'web',
                'show_name' => 'Site Cache - Can Refresh',
            ],

            // Commands Routes
            // [
            //     'name' => 'commands.command',
            //     'guard_name' => 'web',
            //     'show_name' => 'Can Run Artisan Commands',
            // ],

            // Payment Method Routes
            [
                'name' => 'payment-methods.index',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can View',
            ],
            [
                'name' => 'payment-methods.create',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can Create',
            ],
            [
                'name' => 'payment-methods.store',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can Store',
            ],
            [
                'name' => 'payment-methods.edit',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can Edit',
            ],
            [
                'name' => 'payment-methods.update',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can Update',
            ],
            [
                'name' => 'payment-methods.destroy',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can Delete',
            ],
            [
                'name' => 'payment-methods.export',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can Export',
            ],

            // International Ids Routes
            [
                'name' => 'international-ids.index',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can View',
            ],
            [
                'name' => 'international-ids.create',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Create',
            ],
            [
                'name' => 'international-ids.store',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Store',
            ],
            [
                'name' => 'international-ids.edit',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Edit',
            ],
            [
                'name' => 'international-ids.update',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Update',
            ],
            [
                'name' => 'international-ids.destroy',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Delete',
            ],
            [
                'name' => 'international-ids.export',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Export',
            ],

            // Cabin Types Routes
            [
                'name' => 'cabin-types.index',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can View',
            ],
            [
                'name' => 'cabin-types.create',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Create',
            ],
            [
                'name' => 'cabin-types.store',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Store',
            ],
            [
                'name' => 'cabin-types.edit',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Edit',
            ],
            [
                'name' => 'cabin-types.update',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Update',
            ],
            [
                'name' => 'cabin-types.destroy',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Delete',
            ],
            [
                'name' => 'cabin-types.export',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Export',
            ],

            // Cabins Routes
            [
                'name' => 'cabins.index',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can View',
            ],
            [
                'name' => 'cabins.create',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Create',
            ],
            [
                'name' => 'cabins.store',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Store',
            ],
            [
                'name' => 'cabins.edit',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Edit',
            ],
            [
                'name' => 'cabins.update',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Update',
            ],
            [
                'name' => 'cabins.destroy',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Delete',
            ],
            [
                'name' => 'cabins.export',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Export',
            ],
            [
                'name' => 'cabins.needs-cleaning.update',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Update Need Cleaning Cabins',
            ],

            // Booking Sources Routes
            [
                'name' => 'booking-sources.index',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can View',
            ],
            [
                'name' => 'booking-sources.create',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can Create',
            ],
            [
                'name' => 'booking-sources.store',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can Store',
            ],
            [
                'name' => 'booking-sources.edit',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can Edit',
            ],
            [
                'name' => 'booking-sources.update',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can Update',
            ],
            [
                'name' => 'booking-sources.destroy',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can Delete',
            ],
            [
                'name' => 'booking-sources.export',
                'guard_name' => 'web',
                'show_name' => 'Booking Sources - Can Export',
            ],

            // Customers Routes
            [
                'name' => 'customers.index',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can View',
            ],
            [
                'name' => 'customers.create',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can Create',
            ],
            [
                'name' => 'customers.store',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can Store',
            ],
            [
                'name' => 'customers.edit',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can Edit',
            ],
            [
                'name' => 'customers.update',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can Update',
            ],
            [
                'name' => 'customers.destroy',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can Delete',
            ],
            [
                'name' => 'customers.export',
                'guard_name' => 'web',
                'show_name' => 'Customers - Can Export',
            ],

            // Bookings Routes
            [
                'name' => 'bookings.index',
                'guard_name' => 'web',
                'show_name' => 'Booking - Can View',
            ],
            [
                'name' => 'bookings.create',
                'guard_name' => 'web',
                'show_name' => 'Booking - Can Create Booking',
            ],
            [
                'name' => 'bookings.checkin.index',
                'show_name' => 'Booking - Can View Checkin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bookings.checkout.index',
                'show_name' => 'Booking - Can View Checkout',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bookings.calender.index',
                'show_name' => 'Booking - Can View Calender',
                'guard_name' => 'web',
            ],

            // Booking Payments Routes
            [
                'name' => 'bookings.payments.index',
                'guard_name' => 'web',
                'show_name' => 'Bookings Payments - Can View',
            ],
            [
                'name' => 'bookings.payments.create',
                'guard_name' => 'web',
                'show_name' => 'Bookings Payments - Can Create',
            ],
            [
                'name' => 'bookings.payments.export',
                'guard_name' => 'web',
                'show_name' => 'Bookings Payments - Can Export',
            ],

            // Booking Taxes Routes
            [
                'name' => 'booking-taxes.index',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can View',
            ],
            [
                'name' => 'booking-taxes.create',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Create',
            ],
            [
                'name' => 'booking-taxes.store',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Store',
            ],
            [
                'name' => 'booking-taxes.edit',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Edit',
            ],
            [
                'name' => 'booking-taxes.update',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Update',
            ],
            [
                'name' => 'booking-taxes.destroy',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Delete',
            ],
            [
                'name' => 'booking-taxes.export',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Export',
            ],
            [
                'name' => 'booking-taxes.set-default',
                'guard_name' => 'web',
                'show_name' => 'Booking Taxes - Can Set Default',
            ],
        ];

        $role = (new Role())->first();

        foreach ($data as $permission) {
            $permission = (new Permission())->create($permission)->assignRole($role);
        }
    }
}
