<?php

namespace Database\Seeders;

use App\Models\BookingSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSourceSeeder extends Seeder
{
    use WithoutModelEvents;

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
                'slug' => Str::of('In Person')->slug(),
                'description' => 'In Person',
            ],
            [
                'name' => 'Telephone',
                'slug' => Str::of('Telephone')->slug(),
                'description' => 'Telephone',
            ],
            [
                'name' => 'Internet',
                'slug' => Str::of('Internet')->slug(),
                'description' => 'Internet',
            ],
            [
                'name' => 'Other',
                'slug' => Str::of('Other')->slug(),
                'description' => 'Other',
            ],
            [
                'name' => 'AirBnb',
                'slug' => Str::of('AirBnb')->slug(),
                'description' => 'Other',
            ],
            [
                'name' => 'BookingCom',
                'slug' => Str::of('BookingCom')->slug(),
                'description' => 'Booking.com',
            ],
        ];

        foreach ($data as $key => $bookingSource) {
            (new BookingSource())->create($bookingSource);
        }
    }
}
