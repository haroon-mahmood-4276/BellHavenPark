<?php

namespace Database\Seeders;

use App\Models\CustomerRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerRatingSeeder extends Seeder
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
            CustomerRating::truncate();
            CustomerRating::factory()->count(1000)->create();
        }
    }
}
