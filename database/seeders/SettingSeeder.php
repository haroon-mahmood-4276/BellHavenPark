<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        $data = [

            // General Tab
            [
                'key' => "app_name",
                'value' => "Bell Haven Park",
            ],

            // Utilities Tab
            // Electric Values
            [
                'key' => "electricity_base_rate",
                'value' => 123,
            ],
            [
                'key' => "electricity_tax",
                'value' => 1,
            ],
            [
                'key' => "electricity_is_percentage",
                'value' => 0,
            ],
            [
                'key' => "electricity_flat_rate_percentage",
                'value' => 0,
            ],
            [
                'key' => "electricity_sac_rate",
                'value' => 0,
            ],

            // Gas Values
            [
                'key' => "gas_base_rate",
                'value' => 123,
            ],
            [
                'key' => "gas_tax",
                'value' => 2,
            ],
            [
                'key' => "gas_is_percentage",
                'value' => 0,
            ],
            [
                'key' => "gas_flat_rate_percentage",
                'value' => 0,
            ],
            [
                'key' => "gas_sac_rate",
                'value' => 0,
            ],

            // Water Values
            [
                'key' => "water_base_rate",
                'value' => 123,
            ],
            [
                'key' => "water_tax",
                'value' => 3,
            ],
            [
                'key' => "water_is_percentage",
                'value' => 0,
            ],
            [
                'key' => "water_flat_rate_percentage",
                'value' => 0,
            ],
            [
                'key' => "water_sac_rate",
                'value' => 123,
            ],
        ];

        foreach ($data as $setting) {
            (new Setting())->create($setting);
        }
    }
}
