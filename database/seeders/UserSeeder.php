<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        $role = (new Role())->first();

        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@bellhavenpark.com.au',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        ];

        foreach ($data as $key => $user) {
            $user = (new User())->create($user);
            $user->assignRole($role);
        }
    }
}
