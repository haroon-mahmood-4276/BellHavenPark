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

    public function getById($id)
    {
        return $this->model()->find($id);
    }

    public function getBookedCabinsWithinDates($start_date, $end_date)
    {
        $model = $this->model()->select('cabin_id')
            ->where('booking_to', '>=', (new Carbon())->parse($start_date)->timestamp)
            ->where('booking_from', '<=', (new Carbon())->parse($end_date)->timestamp)
            ->where('status', '!=', 'checked_out');

        return $model->get();
    }

    public function store($inputs)
    {

        $data = [

            'haven_cabin_id' => $inputs['cabin_id'],
            'haven_customer_id' => $inputs['customers'],
            'booking_from' => filter_strip_tags($inputs['booking_date_from']),
            'booking_to' => filter_strip_tags($inputs['booking_date_to']),
            'haven_booking_source_id' => $inputs['booking_source'],
            'daily_rate' => $inputs['txt_daily_rate'] ?? 0,
            'daily_less_booking_percentage' => $inputs['txt_daily_less_booking_percentage'] ?? 0,
            'weekly_rate' => $inputs['txt_weekly_rate'] ?? 0,
            'weekly_rate_less_booking_percentage' => $inputs['txt_weekly_rate_less_booking_percentage'] ?? 0,
            'four_weekly_rate' => $inputs['txt_four_weekly_rate'] ?? 0,
            'four_weekly_less_booking_percentage' => $inputs['txt_four_weekly_less_booking_percentage'] ?? 0,
            'check_in' => filter_strip_tags($inputs['btn_check_in']),
            'check_in_date' => $inputs['btn_check_in'] == 'now' ? now() : null,
            'tax_percentage' => $inputs['booking_tax'],
            // 'tax_rate' => ,
            'electricity_included' => filter_strip_tags($inputs['electricity_included']) == 'included' ? 1 : 0,
            'status' => $inputs['btn_check_in'] == 'now' ? 'waiting_for_check_out' : 'waiting_for_check_in',
            'comments' => filter_strip_tags($inputs['comments']),
            'payment' => filter_strip_tags($inputs['btn_payment']),
        ];

        // dd($data);

        $result = $this->model()->create($data);


        if (filter_strip_tags($inputs['btn_payment']) == 'now') {
            $data = [
                'haven_user_id' => auth()->user()->id,
                'haven_booking_id' => $result->id,
                'haven_customer_id' => $inputs['customers'],
                'payment_credit' => (float)$inputs['advance_payment'],
                'payment_debit' => 0,
                'payment_balance' => (float)$inputs['advance_payment'],
                'status' => 'credit',
                'type' => 'advanced',
            ];

            $paymentRecord = (new Payment())->storePayments($data);
        }







        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'cabin_id' => $inputs['cabin_id'],
                'customer_id' => $inputs['customer_id'],
                'booking_from' => $inputs['booking_from'],
                'booking_to' => $inputs['booking_to'],
                'booking_source_id',
                'daily_rate',
                'daily_less_booking_percentage',
                'weekly_rate',
                'weekly_rate_less_booking_percentage',
                'monthly_rate',
                'monthly_less_booking_percentage',
                'check_in',
                'check_in_date',
                'check_out_date',
                'tax',
                'status',
                'comments',
                'payment',
            ];

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
