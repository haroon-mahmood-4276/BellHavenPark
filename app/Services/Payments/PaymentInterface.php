<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function model();

    public function storeRentPayment($booking, $inputs);

    public function creditAccountPayment($customer_id);

    public function lastPaymentDate($booking);
}
