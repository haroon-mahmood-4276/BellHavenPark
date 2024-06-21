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
                'monthly_rate' => $booking->four_weekly_rate,
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
                'credit_amount' => $amount,
                'debit_amount' => 0,
                'account' => CustomerAccounts::RENT,
                'additional_data' => [
                    'rate_type' => $inputs['rate_type'],
                    'daily_rate' => $booking->daily_rate,
                    'weekly_rate' => $booking->weekly_rate,
                    'monthly_rate' => $booking->four_weekly_rate,
                    'days_count' => $inputs['text_days_count'],
                    'tax_flat' => $inputs['tax_flat'],
                    'tax' => $inputs['tax'],
                ],
                'comments' => $inputs['comments'],
            ];

            $this->model()->create($data);
            sleep(1);
            $isPyamentMethodLinked = $this->paymentMethodInterface->find(intval($inputs['payment_methods']))?->linked_account;
            if (!is_null($isPyamentMethodLinked)) {

                $this->addCrditAccountAmount(
                    $booking->customer_id,
                    $inputs['payment_methods'],
                    0 - $amount,
                    booking_id: $booking->id,
                    payment_from: Carbon::parse($inputs['payment_from'])->timestamp,
                    payment_to: Carbon::parse($inputs['payment_to'])->timestamp,
                    additional_data: [
                        'booking_id' => $booking->id,
                        'rate_type' => $inputs['rate_type'],
                        'daily_rate' => $booking->daily_rate,
                        'weekly_rate' => $booking->weekly_rate,
                        'monthly_rate' => $booking->four_weekly_rate,
                        'days_count' => $inputs['text_days_count'],
                        'tax_flat' => $inputs['tax_flat'],
                        'tax' => $inputs['tax'],
                    ],
                    comment: "Amount $" . number_format($amount) . " is deducted from credit account for rent. " . $inputs['comments']
                );
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
                'credit_amount' => $inputs['amount'],
                'debit_amount' => 0,
                'account' => match ($inputs['payment_type']) {
                    'electricity_payment' => CustomerAccounts::ELECTRICITY,
                    'gas_payment' => CustomerAccounts::GAS,
                    'water_payment' => CustomerAccounts::WATER,
                },
                'additional_data' => [],
                'comments' => "Amount $" . number_format($inputs['amount']) . " is paid for Utility. " . $inputs['comments'],
            ];

            $this->model()->create($data);
            sleep(1);
            $isPyamentMethodLinked = $this->paymentMethodInterface->find(intval($inputs['payment_methods']))?->linked_account;
            if (!is_null($isPyamentMethodLinked)) {

                $this->addCrditAccountAmount(
                    $booking->customer_id,
                    $inputs['payment_methods'],
                    0 - $inputs['amount'],
                    booking_id: $booking->id,
                    payment_from: 0,
                    payment_to: 0,
                    additional_data: [
                        'booking_id' => $booking->id,
                    ],
                    comment: "Amount $" . number_format($inputs['amount']) . " is deducted from credit account for Utility. " . $inputs['comments']
                );
            }
        });
    }

    public function addCrditAccountAmount($customer_id, $payment_method, $amount, $booking_id = null, $payment_from = 0, $payment_to = 0, $additional_data = [], $comment = '')
    {
        $data = [
            'booking_id' => $booking_id,
            'payment_method_id' => $payment_method,
            'customer_id' => $customer_id,
            'payment_from' => $payment_from,
            'payment_to' => $payment_to,
            'account' => CustomerAccounts::CREDIT_ACCOUNT,
            'additional_data' => $additional_data,
            'comments' => $comment,
        ];

        if ($amount >= 0) {
            $data['credit_amount'] = abs($amount);
            $data['debit_amount'] = 0;
        } else {
            $data['credit_amount'] = 0;
            $data['debit_amount'] = abs($amount);
        }

        $this->model()->create($data);
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
        $epochDate = $this->model()->where(['booking_id' => $booking_id, 'account' => CustomerAccounts::RENT])->where('credit_amount', '>', 0)->latest('payment_to')->first()?->payment_to;
        if (!is_null($epochDate)) {
            return Carbon::parse($epochDate);
        }
        return null;
    }
}
