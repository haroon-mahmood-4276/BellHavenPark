<?php

namespace App\Services\Payments;

use App\Models\Payment;
use App\Services\Payments\PaymentInterface;
use Exception;

class PaymentService implements PaymentInterface
{

    public function model()
    {
        return new Payment();
    }

    public function getByBookingId($booking_id)
    {
        try {
            $booking_id = decryptParams($booking_id);
            return $this->model()->whereHavenBookingId($booking_id)->get();
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getAdvancedPaymentBookingId($booking_id)
    {
        try {
            $booking_id = decryptParams($booking_id);
            if ($advancedPayment = $this->model()->where([ 'haven_booking_id' => $booking_id, 'type' => 'advanced' ])->first()) {
                return $advancedPayment->payment_credit;
            }
            return 0;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function store($booking_id, $data)
    {
        try {
            return $this->model()->create($data);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
