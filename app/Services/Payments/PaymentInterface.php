<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function model();

    public function storeRentPayment($booking, $inputs);
    
    public function storeUtilityPayment($booking, $inputs);

    public function accountAmount($customer_id, $account);

    public function lastPaymentDate($booking);
}
