<?php

namespace App\Services\Payments;

use App\Models\Payment;
use App\Utils\Enums\PaymentStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService1 implements PaymentInterface
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
        if ($advancedPayment = $this->model()->where(['booking_id' => $booking_id, 'type' => PaymentStatus::ADVANCE])->first()) {
            return $advancedPayment->credit;
        }
        return 0;
    }

    public function getLastPaymentDateByBookingId($booking_id)
    {
        return Carbon::parse($this->model()->where(['booking_id' => $booking_id, 'type' => PaymentStatus::RECEIVED])->latest('payment_to')->first()?->payment_to);
    }

    public function store($booking_id, $inputs)
    {
        return DB::transaction(function () use ($booking_id, $inputs) {

            // $netTotal is without tax
            $netTotal = match ($inputs['rate_type']) {
                'daily_rate' => floatval($inputs['txt_daily_total']),
                'weekly_rate' => floatval($inputs['txt_weekly_total']),
                'four_weekly_rate' => floatval($inputs['txt_four_weekly_total']),
            } * $inputs['days_count'];

            $tax = floatval(($netTotal * ($inputs['tax'] ?? 0)) / 100);

            $subTotal = floatval($netTotal + $tax);

            $grossTotal = floatval($subTotal - floatval($inputs['advance_payment']));

            $data = [
                'booking_id' => $booking_id,
                'payment_method_id' => $inputs['payment_methods'],
                'payment_from' => Carbon::parse($inputs['payment_from'])->startOfDay()->addSeconds(18000)->timestamp,
                'payment_to' => Carbon::parse($inputs['payment_to'])->startOfDay()->addSeconds(18000)->timestamp,
                'credit' => $grossTotal,
                'debit' => null,
                'balance' => 0,
                'status' => 'credit',
                'payment_type' => $inputs['rate_type'],
                'type' => PaymentStatus::RECEIVED,
                'comments' => $inputs['comments'],
            ];

            $payment_method = $this->model()->create($data);
            return $payment_method;
        });
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
