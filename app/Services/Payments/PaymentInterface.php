<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    public function getAll($ignore = null);

    public function getById($id, $relationships = []);

    public function getAdvancedPaymentBookingId($booking_id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}
