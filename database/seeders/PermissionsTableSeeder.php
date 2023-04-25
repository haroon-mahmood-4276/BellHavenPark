<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Permission())->insert([
            [
                // 'id' => 1,
                'name' => 'Roles',
                'slug' => Str::of('Roles')->slug('_'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 2,
                'name' => 'Permissions',
                'slug' => Str::of('Permissions')->slug('_'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
			[
				// 'id' => 3,
				'name' => 'App Settings',
				'slug' => Str::of('App Settings')->slug('_'),
                'created_at' => now(),
                'updated_at' => now(),
			],
        ]);
    }
}
