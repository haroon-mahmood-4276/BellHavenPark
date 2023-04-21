<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService implements PaymentInterface
{
    private function model()
    {
        return new Payment();
    }

    public function getAll($ignore = null)
    {
        $payment_method = $this->model();
        if (is_array($ignore)) {
            $payment_method = $payment_method->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $payment_method = $payment_method->where('id', '!=', $ignore);
        }
        $payment_method = $payment_method->get();
        return $payment_method;
    }

    public function getById($id, $relationships = [])
    {
        $brand = $this->model();

        if (count($relationships) > 0) {
            $brand = $brand->with($relationships);
        }

        return $brand->find($id);
    }

    public function getAdvancedPaymentBookingId($booking_id)
    {
        $booking_id = decryptParams($booking_id);
        if ($advancedPayment = $this->model()->where(['booking_id' => $booking_id, 'type' => 'advanced'])->first()) {
            return $advancedPayment->payment_credit;
        }
        return 0;
    }

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $payment_method = $this->model()->create($data);
            return $payment_method;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $payment_method = $this->model()->find($id)->update($data);
            return $payment_method;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $payment_method = $this->model()->whereIn('id', $inputs)->get()->each(function ($payment_method) {
                $payment_method->delete();
            });

            return $payment_method;
        });

        return $returnData;
    }
}
