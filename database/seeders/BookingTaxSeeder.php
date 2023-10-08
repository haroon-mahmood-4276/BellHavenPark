<?php

namespace Database\Seeders;

use App\Models\BookingTax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingTax::truncate();
        $data = [
            [
                'name' => 'VAT 7%',
                'amount' => 7,
                'is_flat' => false,
                'is_default' => false,
            ],
            [
                'name' => 'GST 10%',
                'amount' => 7,
                'is_flat' => false,
                'is_default' => true,
            ],
            [
                'name' => 'GST 10Rs',
                'amount' => 7,
                'is_flat' => true,
                'is_default' => false,
            ],
        ];

        foreach ($data as $key => $row) {
            (new BookingTax())->create($row);
        }
    }
}
