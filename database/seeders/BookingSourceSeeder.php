<?php

namespace Database\Seeders;

use App\Models\BookingSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookingSource::truncate();
        $data = [
            [
                // 'id' => 1,
                'name' => 'In Person',
                'description' => 'In Person',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 2,
                'name' => 'Telephone',
                'description' => 'Telephone',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 3,
                'name' => 'Internet',
                'description' => 'Internet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 4,
                'name' => 'Other',
                'description' => 'Other',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $key => $bookingSource) {
            (new BookingSource())->create($bookingSource);
        }
    }
}
