<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Utils\Enums\CustomerAccounts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentMethodSeeder extends Seeder
{
    use WithoutModelEvents;
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
                'slug' => Str::of('Cheque')->slug(),
                'linked_account' => null
            ],
            [
                'name' => 'Direct Debit',
                'slug' => Str::of('Direct Debit')->slug(),
                'linked_account' => null
            ],
            [
                'name' => 'EFTPOS',
                'slug' => Str::of('EFTPOS')->slug(),
                'linked_account' => null
            ],
            [
                'name' => 'EFTPOS Refund',
                'slug' => Str::of('EFTPOS Refund')->slug(),
                'linked_account' => null
            ],
            [
                'name' => 'EFTPOS WESTPAC 284',
                'slug' => Str::of('EFTPOS WESTPAC 284')->slug(),
                'linked_account' => null
            ],
            [
                'name' => 'Misc Credit Acc',
                'slug' => Str::of('Misc Credit Acc')->slug(),
                'linked_account' => CustomerAccounts::CREDIT_ACCOUNT
            ],
            [
                'name' => 'Other',
                'slug' => Str::of('Other')->slug(),
                'linked_account' => null
            ],
            [
                'name' => 'PrePayment',
                'slug' => Str::of('PrePayment')->slug(),
                'linked_account' => null
            ],
        ];

        foreach ($data as $payment_method) {
            (new PaymentMethod())->create($payment_method);
        }
    }
}
