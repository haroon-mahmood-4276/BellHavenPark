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
                'name' => 'In Person',
                'description' => 'In Person',
            ],
            [
                'name' => 'Telephone',
                'description' => 'Telephone',
            ],
            [
                'name' => 'Internet',
                'description' => 'Internet',
            ],
            [
                'name' => 'Other',
                'description' => 'Other',
            ],
        ];

        foreach ($data as $key => $bookingSource) {
            (new BookingSource())->create($bookingSource);
        }
    }
}
