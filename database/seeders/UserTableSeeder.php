<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new User())->create([
            'name' => 'Admin',
			'email' => 'admin@bellhavenpark.com.au',
			'password' => Hash::make('12345678'),
			'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'haven_role_id' => 2,
        ]);
    }
}
