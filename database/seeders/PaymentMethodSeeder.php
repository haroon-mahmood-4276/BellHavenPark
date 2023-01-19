<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::truncate();
        $data = [
            [
                'name' => 'Cheque',
            ],
            [
                'name' => 'Direct Debit',
            ],
            [
                'name' => 'EFTPOS',
            ],
            [
                'name' => 'EFTPOS Refund',
            ],
            [
                'name' => 'EFTPOS WESTPAC 284',
            ],
            [
                'name' => 'Misc Credit Acc',
            ],
            [
                'name' => 'Other',
            ],
            [
                'name' => 'PrePayment',
            ],
        ];

        foreach ($data as $payment_method) {
            (new PaymentMethod())->create($payment_method);
        }
    }
}
