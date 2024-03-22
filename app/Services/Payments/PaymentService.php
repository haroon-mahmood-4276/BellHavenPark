<?php

namespace App\Services\Payments;

use App\Models\Payment;
use App\Services\PaymentMethods\PaymentMethodInterface;
use App\Utils\Enums\CustomerAccounts;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentService implements PaymentInterface
{

    private $paymentMethodInterface;

    public function __construct(PaymentMethodInterface $paymentMethodInterface)
    {
        $this->paymentMethodInterface = $paymentMethodInterface;
    }

    public function model()
    {
        return new Payment();
    }

    public function storeRentPayment($booking, $inputs)
    {
        return DB::transaction(function () use ($booking, $inputs) {

            $rate = match ($inputs['rate_type']) {
                'daily_rate' => $booking->daily_rate,
                'weekly_rate' => $booking->weekly_rate,
                'four_weekly_rate' => $booking->four_weekly_rate,
            };

            $amount = floatval($rate * intval($inputs['text_days_count']));

            $amount += floatval(match (boolval($inputs['tax_flat'])) {
                true => floatval($inputs['tax']),
                false => (floatval($amount)  * floatval($inputs['tax'])) / 100,
            });

            $data = [
                'booking_id' => $booking->id,
                'payment_method_id' => $inputs['payment_methods'],
                'customer_id' => $booking->customer_id,
                'payment_from' => Carbon::parse($inputs['payment_from'])->timestamp,
                'payment_to' => Carbon::parse($inputs['payment_to'])->timestamp,
                'amount' => $amount,
                'balance' => 0,
                'account' => CustomerAccounts::RENT,
                'comments' => $inputs['comments'],
            ];

            $this->model()->create($data);

            $isPyamentMethodLinked = $this->paymentMethodInterface->find(intval($inputs['payment_methods']))?->linked_account;
            if (!is_null($isPyamentMethodLinked)) {
                $data = [
                    'booking_id' => $booking->id,
                    'payment_method_id' => $inputs['payment_methods'],
                    'customer_id' => $booking->customer_id,
                    'payment_from' => Carbon::parse($inputs['payment_from'])->timestamp,
                    'payment_to' => Carbon::parse($inputs['payment_to'])->timestamp,
                    'amount' => $amount,
                    'balance' => 0,
                    'transaction_type' => TransactionType::CASH,
                    'comments' => $inputs['comments'],
                ];
                switch ($isPyamentMethodLinked->value) {
                    case 'credit_account':
                        $data['account'] = CustomerAccounts::CREDIT_ACCOUNT;
                        $data['status'] = PaymentStatus::PAID;
                        break;
                }

                $this->model()->create($data);
            }
        });
    }

    public function storeUtilityPayment($booking, $inputs)
    {
        return DB::transaction(function () use ($booking, $inputs) {

            $data = [
                'booking_id' => $booking->id,
                'payment_method_id' => $inputs['payment_methods'],
                'customer_id' => $booking->customer_id,
                'payment_from' => 0,
                'payment_to' => 0,
                'amount' => $inputs['amount'],
                'balance' => 0,
                'account' => match ($inputs['payment_type']) {
                    'electricity_payment' => CustomerAccounts::ELECTRICITY,
                    'gas_payment' => CustomerAccounts::GAS,
                    'water_payment' => CustomerAccounts::WATER,
                },
                'transaction_type' => TransactionType::CASH,
                'status' => PaymentStatus::RECEIVED,
                'comments' => $inputs['comments'],
                'payment_type' => match ($inputs['payment_type']) {
                    'electricity_payment' => PaymentType::ELECTRIC,
                    'gas_payment' => PaymentType::GAS,
                    'water_payment' => PaymentType::WATER,
                }
            ];

            $this->model()->create($data);

            $isPyamentMethodLinked = $this->paymentMethodInterface->find(intval($inputs['payment_methods']))?->linked_account;
            if (!is_null($isPyamentMethodLinked)) {
                $data = [
                    'booking_id' => $booking->id,
                    'payment_method_id' => $inputs['payment_methods'],
                    'customer_id' => $booking->customer_id,
                    'payment_from' => 0,
                    'payment_to' => 0,
                    'amount' => $inputs['amount'],
                    'balance' => 0,
                    'transaction_type' => TransactionType::CASH,
                    'comments' => $inputs['comments'],
                    'payment_type' => match ($inputs['payment_type']) {
                        'electricity_payment' => PaymentType::ELECTRIC,
                        'gas_payment' => PaymentType::GAS,
                        'water_payment' => PaymentType::WATER,
                    }
                ];
                switch ($isPyamentMethodLinked->value) {
                    case 'credit_account':
                        $data['account'] = CustomerAccounts::CREDIT_ACCOUNT;
                        $data['status'] = PaymentStatus::PAID;
                        break;
                }

                $this->model()->create($data);
            }
        });
    }

    public function accountAmount($customer_id, $account)
    {
        $total_credit = $this->model()->where([
            'customer_id' => $customer_id,
            'account' => $account,
        ])->sum('credit_amount');

        $total_debit = $this->model()->where([
            'customer_id' => $customer_id,
            'account' => $account,
        ])->sum('debit_amount');

        return $total_credit - $total_debit;
    }

    public function lastPaymentDate($booking_id)
    {
        $epochDate = $this->model()->where(['booking_id' => $booking_id, 'account' => CustomerAccounts::RENT, 'status' => PaymentStatus::RECEIVED])->latest('payment_to')->first()?->payment_to;
        if (!is_null($epochDate))
            return Carbon::parse($epochDate);
        return null;
    }
}
