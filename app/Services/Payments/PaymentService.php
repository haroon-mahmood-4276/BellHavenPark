<?php

namespace App\Services\Payments;

use App\Models\Payment;
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
                'credit' => $inputs['credit'],
                'debit' => $inputs['debit'],
                'balance' => $inputs['balance'],
                'account' => $inputs['account'],
                'transaction_type' => $inputs['transaction_type'],
                'status' => $inputs['status'],
                'comments' => $inputs['comments'],
            ];

            return $this->model()->create($data);
        });
    }
}
