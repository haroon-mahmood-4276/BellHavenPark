<?php

namespace App\Services\Bookings;

use App\Models\Booking;
use App\Models\Payment;
use App\Services\Payments\PaymentInterface;
use App\Utils\Enums\CustomerAccounts;
use App\Utils\Enums\PaymentStatus;
use App\Utils\Enums\TransactionType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService implements BookingInterface
{
    private $paymentInterface;

    public function __construct(PaymentInterface $paymentInterface)
    {
        $this->paymentInterface = $paymentInterface;
    }

    private function model()
    {
        return new Booking();
    }

    public function get($ignore = null, $relationships = [], $only = 'all')
    {
        $booking = $this->model();
        if (is_array($ignore)) {
            $booking = $booking->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $booking = $booking->where('id', '!=', $ignore);
        }
        if (count($relationships) > 0) {
            $booking = $booking->with($relationships);
        }

        switch ($only) {
            case 'booked':
                $booking = $booking->where([
                    ['check_in_date', "<", 1],
                    ['check_out_date', "<", 1],
                ]);
                break;
            case 'checkedin':
                $booking = $booking->where([
                    ['check_in_date', ">", 0],
                    ['check_out_date', "<", 1],
                ]);
                break;
            case 'checkedout':
                $booking = $booking->where([
                    ['check_out_date', ">", 0],
                ]);
        }

        $booking = $booking->get();
        return $booking;
    }

    public function find($id, $relationships = [])
    {
        $booking = $this->model();

        if (count($relationships) > 0) {
            $booking = $booking->with($relationships);
        }

        return $booking->find($id);
    }

    public function getBookedCabinsWithinDates($start_date, $end_date)
    {
        $model = $this->model()->select('cabin_id')
            ->where('booking_to', '>=', $start_date->timestamp)
            ->where('booking_from', '<=', $end_date->timestamp)
            ->where('status', '!=', 'checked_out');

        return $model->get();
    }

    public function store($inputs)
    {

        return DB::transaction(function () use ($inputs) {
            $data = [
                'cabin_id' => $inputs['cabin_id'],
                'customer_id' => $inputs['customer'],

                'booking_number' => $this->model()->max('booking_number') + 1,

                'booking_from' => $inputs['booking_from'],
                'booking_to' => $inputs['booking_to'],

                'booking_source_id' => $inputs['booking_source'],

                'daily_rate' => $inputs['daily_rate'] ?? 0,
                'daily_less_booking_percentage' => $inputs['daily_less_booking_percentage'] ?? 0,

                'weekly_rate' => $inputs['weekly_rate'] ?? 0,
                'weekly_rate_less_booking_percentage' => $inputs['weekly_rate_less_booking_percentage'] ?? 0,

                'four_weekly_rate' => $inputs['four_weekly_rate'] ?? 0,
                'four_weekly_less_booking_percentage' => $inputs['four_weekly_less_booking_percentage'] ?? 0,

                'check_in' => $inputs['check_in'],
                'check_in_date' => $inputs['check_in'] == 'now' ? now()->timestamp : 0,

                'check_out_date' => 0,
                'booking_tax_id' => (int)$inputs['booking_tax'],

                'comments' => $inputs['comments'],
                'payment' => $inputs['payment'],

                'status' => true,
            ];

            $booking = $this->model()->create($data);

            $booking->tenants()->sync($inputs['tenants'] ?? []);

            if ($inputs['payment'] == 'now') {
                $data = [
                    'customer_id' => $inputs['customer'],
                    'booking_id' => $booking->id,
                    'payment_method_id' => $inputs['payment_methods'],
                    'payment_from' => 0,
                    'payment_to' => 0,
                    'amount' => (float)$inputs['advance_payment'],
                    'balance' => (float)$inputs['advance_payment'],
                    'account' => CustomerAccounts::CREDIT_ACCOUNT,
                    'transaction_type' => TransactionType::ADVANCE,
                    'status' => PaymentStatus::RECEIVED,
                    'comments' => 'Advance Payment',
                ];

                $this->paymentInterface->store($data);
            }

            return $booking;
        });
    }

    public function storeCheckIn($id)
    {
        $returnData = DB::transaction(function () use ($id) {
            $data = [
                'check_in_date' => now()->timestamp,
            ];
            $booking = $this->model()->find($id)->update($data);

            return $booking;
        });

        return $returnData;
    }

    public function storeCheckOut($id)
    {
        $returnData = DB::transaction(function () use ($id) {
            $data = [
                'check_out_date' => now()->timestamp,
            ];
            $booking = $this->model()->find($id)->update($data);

            return $booking;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
                'description' => $inputs['description'],
            ];

            $booking = $this->model()->find($id)->update($data);
            return $booking;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $booking = $this->model()->whereIn('id', $inputs)->get()->each(function ($booking) {
                $booking->delete();
            });

            return $booking;
        });

        return $returnData;
    }
}
