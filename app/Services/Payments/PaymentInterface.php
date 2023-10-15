<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function store($inputs);

    public function advancePayments($customer_id);

    public function lastPaymentDate($booking_id);
}
