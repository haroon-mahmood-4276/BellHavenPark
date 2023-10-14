<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function store($inputs);
}
