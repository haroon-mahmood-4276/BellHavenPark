<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\InternationalId;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
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
            Customer::truncate();
            Customer::factory()->count(100)->create();
        }
    }
}
