<?php

namespace Database\Seeders;

use App\Models\Cabin;
use App\Models\CabinType;
use App\Utils\Enums\CabinStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabinSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() === 'local') {
            foreach ((new CabinType())->all() as $key => $cabinType) {
                (new Cabin())->create([
                    'cabin_type_id' => $cabinType->id,
                    'cabin_status' => CabinStatus::OPEN,
                    'name' => 'Cabin ' . ($key + 1),
                    'long_term' => true,
                    'electric_meter' => true,
                    'daily_rate' => 0,
                    'weekly_rate' => 0,
                    'monthly_rate' => 0,
                ]);
            }
        }
    }
}
