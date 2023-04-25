<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new PaymentMethod())->insert([
            [
                // 'id' => 2,
                'name' => 'Cheque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 3,
                'name' => 'Direct Debit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 4,
                'name' => 'EFTPOS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 5,
                'name' => 'EFTPOS Refund',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 6,
                'name' => 'EFTPOS WESTPAC 284',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 7,
                'name' => 'Misc Credit Acc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 8,
                'name' => 'Other',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 'id' => 9,
                'name' => 'PrePayment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
