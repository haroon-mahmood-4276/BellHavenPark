<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function getByBookingId($booking_id);

    public function getAdvancedPaymentBookingId($booking_id);

    public function store($booking_id, $data);
}
