<?php

namespace App\Services\Bookings;

use App\Models\Booking;
use App\Models\Payment;
use App\Services\Bookings\BookingInterface;
use Exception;

class BookingService implements BookingInterface
{

    public function model()
    {
        return new Booking();
    }

    public function getById($id)
    {
        $id = decryptParams($id);

        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        try {
            // dd($request->post());
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

            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function update($id, $inputs)
    {
        try {
            $id = decryptParams($id);
            $record = $this->model()->whereId($id)->update($inputs);
            return $record;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function destroy($id)
    {
        try {
            $id = decryptParams($id);

            $this->model()->whereIn('id', $id)->delete();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
