<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Role, Permission};

class PermissionSeeder extends Seeder
{
    use WithoutModelEvents;

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
                'show_name' => 'Roles - Can View',
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web',
                'show_name' => 'Role - Can Create',
            ],
            [
                'name' => 'roles.store',
                'guard_name' => 'web',
                'show_name' => 'Role - Can Store',
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'show_name' => 'Role - Can Edit',
            ],
            [
                'name' => 'roles.update',
                'guard_name' => 'web',
                'show_name' => 'Role - Can Update',
            ],
            [
                'name' => 'roles.destroy',
                'guard_name' => 'web',
                'show_name' => 'Role - Can Delete',
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
            [
                'name' => 'permissions.view_all',
                'guard_name' => 'web',
                'show_name' => 'All Site Roles Permissions - Can View',
            ],
            // [
            //     'name' => 'permissions.create',
            //     'guard_name' => 'web',
            //     'show_name' => 'Permissions - Can Create',
            // ],
            // [
            //     'name' => 'permissions.store',
            //     'guard_name' => 'web',
            //     'show_name' => 'Permissions - Can Store',
            // ],
            // [
            //     'name' => 'permissions.edit',
            //     'guard_name' => 'web',
            //     'show_name' => 'Permissions - Can Edit',
            // ],
            // [
            //     'name' => 'permissions.update',
            //     'guard_name' => 'web',
            //     'show_name' => 'Permissions - Can Update',
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Permission - Can Delete',
            // ],
            // [
            //     'name' => 'permissions.destroy',
            //     'guard_name' => 'web',
            //     'show_name' => 'Selected Permissions - Can Delete',
            // ],
            [
                'name' => 'permissions.assign-permission',
                'guard_name' => 'web',
                'show_name' => 'Permission - Can Assign',
            ],
            [
                'name' => 'permissions.revoke-permission',
                'guard_name' => 'web',
                'show_name' => 'Permission - Can Revoke',
            ],
            [
                'name' => 'permissions.edit-own-permission',
                'guard_name' => 'web',
                'show_name' => 'Own Permission - Can Edit',
            ],

            // Sites Routes
            [
                'name' => 'cache.flush',
                'guard_name' => 'web',
                'show_name' => 'Site Cache - Can Refresh',
            ],

            // Payment Method Routes
            [
                'name' => 'payment-methods.index',
                'guard_name' => 'web',
                'show_name' => 'Payment Methods - Can View',
            ],
            [
                'name' => 'payment-methods.create',
                'guard_name' => 'web',
                'show_name' => 'Payment Method - Can Create',
            ],
            [
                'name' => 'payment-methods.store',
                'guard_name' => 'web',
                'show_name' => 'Payment Method - Can Store',
            ],
            [
                'name' => 'payment-methods.edit',
                'guard_name' => 'web',
                'show_name' => 'Payment Method - Can Edit',
            ],
            [
                'name' => 'payment-methods.update',
                'guard_name' => 'web',
                'show_name' => 'Payment Method - Can Update',
            ],
            [
                'name' => 'payment-methods.destroy',
                'guard_name' => 'web',
                'show_name' => 'Payment Method - Can Delete',
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
                'show_name' => 'International Id - Can Create',
            ],
            [
                'name' => 'international-ids.store',
                'guard_name' => 'web',
                'show_name' => 'International Id - Can Store',
            ],
            [
                'name' => 'international-ids.edit',
                'guard_name' => 'web',
                'show_name' => 'International Id - Can Edit',
            ],
            [
                'name' => 'international-ids.update',
                'guard_name' => 'web',
                'show_name' => 'International Id - Can Update',
            ],
            [
                'name' => 'international-ids.destroy',
                'guard_name' => 'web',
                'show_name' => 'International Id - Can Delete',
            ],
            [
                'name' => 'international-ids.export',
                'guard_name' => 'web',
                'show_name' => 'International Ids - Can Export',
            ],

            // Cabin Types Routes
            [
                'name' => 'cabins.types.index',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can View',
            ],
            [
                'name' => 'cabins.types.create',
                'guard_name' => 'web',
                'show_name' => 'Cabin Type - Can Create',
            ],
            [
                'name' => 'cabins.types.store',
                'guard_name' => 'web',
                'show_name' => 'Cabin Type - Can Store',
            ],
            [
                'name' => 'cabins.types.edit',
                'guard_name' => 'web',
                'show_name' => 'Cabin Type - Can Edit',
            ],
            [
                'name' => 'cabins.types.update',
                'guard_name' => 'web',
                'show_name' => 'Cabin Type - Can Update',
            ],
            [
                'name' => 'cabins.types.destroy',
                'guard_name' => 'web',
                'show_name' => 'Cabin Type - Can Delete',
            ],
            [
                'name' => 'cabins.types.export',
                'guard_name' => 'web',
                'show_name' => 'Cabin Types - Can Export',
            ],

            // Cabin Assets Routes
            [
                'name' => 'cabins.assets.index',
                'guard_name' => 'web',
                'show_name' => 'Cabin Assets - Can View',
            ],
            [
                'name' => 'cabins.assets.create',
                'guard_name' => 'web',
                'show_name' => 'Cabin Asset - Can Create',
            ],
            [
                'name' => 'cabins.assets.store',
                'guard_name' => 'web',
                'show_name' => 'Cabin Asset - Can Store',
            ],
            [
                'name' => 'cabins.assets.edit',
                'guard_name' => 'web',
                'show_name' => 'Cabin Asset - Can Edit',
            ],
            [
                'name' => 'cabins.assets.update',
                'guard_name' => 'web',
                'show_name' => 'Cabin Asset - Can Update',
            ],
            [
                'name' => 'cabins.assets.destroy',
                'guard_name' => 'web',
                'show_name' => 'Cabin Asset - Can Delete',
            ],
            [
                'name' => 'cabins.assets.export',
                'guard_name' => 'web',
                'show_name' => 'Cabin Assets - Can Export',
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
                'show_name' => 'Cabin - Can Create',
            ],
            [
                'name' => 'cabins.store',
                'guard_name' => 'web',
                'show_name' => 'Cabin - Can Store',
            ],
            [
                'name' => 'cabins.edit',
                'guard_name' => 'web',
                'show_name' => 'Cabin - Can Edit',
            ],
            [
                'name' => 'cabins.update',
                'guard_name' => 'web',
                'show_name' => 'Cabin - Can Update',
            ],
            [
                'name' => 'cabins.destroy',
                'guard_name' => 'web',
                'show_name' => 'Cabin - Can Delete',
            ],
            [
                'name' => 'cabins.export',
                'guard_name' => 'web',
                'show_name' => 'Cabins - Can Export',
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
                'show_name' => 'Booking Source - Can Create',
            ],
            [
                'name' => 'booking-sources.store',
                'guard_name' => 'web',
                'show_name' => 'Booking Source - Can Store',
            ],
            [
                'name' => 'booking-sources.edit',
                'guard_name' => 'web',
                'show_name' => 'Booking Source - Can Edit',
            ],
            [
                'name' => 'booking-sources.update',
                'guard_name' => 'web',
                'show_name' => 'Booking Source - Can Update',
            ],
            [
                'name' => 'booking-sources.destroy',
                'guard_name' => 'web',
                'show_name' => 'Booking Source - Can Delete',
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
                'show_name' => 'Customer - Can Create',
            ],
            [
                'name' => 'customers.store',
                'guard_name' => 'web',
                'show_name' => 'Customer - Can Store',
            ],
            [
                'name' => 'customers.edit',
                'guard_name' => 'web',
                'show_name' => 'Customer - Can Edit',
            ],
            [
                'name' => 'customers.update',
                'guard_name' => 'web',
                'show_name' => 'Customer - Can Update',
            ],
            [
                'name' => 'customers.destroy',
                'guard_name' => 'web',
                'show_name' => 'Customer - Can Delete',
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
                'show_name' => 'Bookings - Can View',
            ],
            [
                'name' => 'bookings.create',
                'guard_name' => 'web',
                'show_name' => 'Booking - Can Create',
            ],
            [
                'name' => 'bookings.checkin.index',
                'show_name' => 'Checkin - Can View',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bookings.checkout.index',
                'show_name' => 'Checkout - Can View',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bookings.calender.index',
                'show_name' => 'Booking Calender - Can View',
                'guard_name' => 'web',
            ],

            // Booking Payments Routes
            [
                'name' => 'bookings.payments.index',
                'guard_name' => 'web',
                'show_name' => 'Bookings Payment List - Can View',
            ],
            [
                'name' => 'bookings.payments.create',
                'guard_name' => 'web',
                'show_name' => 'Booking Payment - Can Create',
            ],
            [
                'name' => 'bookings.payments.export',
                'guard_name' => 'web',
                'show_name' => 'Payments - Can Export',
            ],
        ];

        $role = (new Role())->first();

        foreach ($data as $permission) {
            $permission = (new Permission())->create($permission)->assignRole($role);
        }
    }
}
