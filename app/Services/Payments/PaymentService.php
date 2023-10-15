<?php

namespace App\Services\Payments;

use App\Models\Payment;
use App\Utils\Enums\CustomerAccounts;
use App\Utils\Enums\PaymentStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService implements PaymentInterface
{
    private function model()
    {
        return new Payment();
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs) {
            $data = [
                'customer_id' => $inputs['customer_id'],
                'booking_id' => $inputs['booking_id'],
                'payment_method_id' => $inputs['payment_method_id'],
                'payment_from' => $inputs['payment_from'],
                'payment_to' => $inputs['payment_to'],
                'amount' => $inputs['amount'],
                'balance' => $inputs['balance'],
                'account' => $inputs['account'],
                'transaction_type' => $inputs['transaction_type'],
                'status' => $inputs['status'],
                'comments' => $inputs['comments'],
            ];

            return $this->model()->create($data);
        });
    }

    public function advancePayments($customer_id)
    {
        $total_credit = $this->model()->where([
            'customer_id' => $customer_id,
            'account' => CustomerAccounts::CREDIT_ACCOUNT,
            'status' => PaymentStatus::RECEIVED
        ])->sum('amount');

        $total_debit = $this->model()->where([
            'customer_id' => $customer_id,
            'account' => CustomerAccounts::CREDIT_ACCOUNT,
            'status' => PaymentStatus::PAID
        ])->sum('amount');

        return $total_credit - $total_debit;
    }

    public function lastPaymentDate($booking_id)
    {
        return Carbon::parse($this->model()->where(['booking_id' => $booking_id, 'status' => PaymentStatus::RECEIVED])->latest('payment_to')->first()?->payment_to);
    }
}
