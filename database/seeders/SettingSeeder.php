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

            // Roles Routes
            [
                'key' => "app_name",
                'value' => "Bell Haven Park",
            ],
        ];

        foreach ($data as $setting) {
            (new Setting())->create($setting);
        }
    }
}
