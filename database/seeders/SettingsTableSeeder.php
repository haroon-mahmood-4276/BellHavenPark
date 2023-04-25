<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ( new Setting() )->insert( [
			[
				// 'id' => '1',
				'key' => 'site_name',
				'value' => 'Bell Haven Park',
                'created_at' => now(),
                'updated_at' => now(),
			],
			[
				// 'id' => '2',
				'key' => 'currency_code',
				'value' => '&#8360;',
                'created_at' => now(),
                'updated_at' => now(),
			],
		] );
    }
}
