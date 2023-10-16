<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function store($inputs);

    public function creditAccountPayment($customer_id);

    public function lastPaymentDate($booking);
}
