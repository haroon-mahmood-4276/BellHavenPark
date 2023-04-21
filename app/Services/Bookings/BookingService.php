<?php

namespace App\Services\Bookings;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService implements BookingInterface
{
    private function model()
    {
        return new Booking();
    }

    public function getAll($ignore = null, $with_tree = false)
    {
        $booking = $this->model();
        if (is_array($ignore)) {
            $booking = $booking->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $booking = $booking->where('id', '!=', $ignore);
        }
        $booking = $booking->get();
        return $booking;
    }

    public function getById($id, $relationships = [])
    {
        $brand = $this->model();

        if(count($relationships) > 0) {
            $brand = $brand->with($relationships);
        }

        return $brand->find($id);
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

        $returnData = DB::transaction(function () use ($inputs) {
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

                'monthly_rate' => $inputs['monthly_rate'] ?? 0,
                'monthly_less_booking_percentage' => $inputs['monthly_less_booking_percentage'] ?? 0,

                'check_in' => $inputs['check_in'],
                'check_in_date' => $inputs['check_in'] == 'now' ? now() : 0,

                'check_out_date' => 0,
                'tax' => (int)$inputs['booking_tax'],

                'comments' => $inputs['comments'],
                'payment' => $inputs['payment'],

                'status' => true,
            ];
            // dd($data);
            // if ($inputs['payment'] == 'now') {
            //     $data = [
            //         'haven_user_id' => auth()->user()->id,
            //         'haven_booking_id' => $result->id,
            //         'haven_customer_id' => $inputs['customers'],
            //         'payment_credit' => (float)$inputs['advance_payment'],
            //         'payment_debit' => 0,
            //         'payment_balance' => (float)$inputs['advance_payment'],
            //         'status' => 'credit',
            //         'type' => 'advanced',
            //     ];

            //     $paymentRecord = (new Payment())->storePayments($data);
            // }

            $booking = $this->model()->create($data);
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
