<?php

namespace App\Services\Bookings;

use App\Models\{Booking, Payment};
use App\Services\Cabins\CabinInterface;
use App\Services\Payments\PaymentInterface;
use App\Utils\Enums\{
    CabinStatus,
    CustomerAccounts,
    PaymentStatus,
    PaymentType,
    TransactionType,
};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

class BookingService implements BookingInterface
{
    private $paymentInterface;
    private $cabinInterface;

    public function __construct(CabinInterface $cabinInterface, PaymentInterface $paymentInterface)
    {
        $this->paymentInterface = $paymentInterface;
        $this->cabinInterface = $cabinInterface;
    }

    private function model()
    {
        return new Booking();
    }

    public function get($ignore = null, $relationships = [], $only = 'all', $sort = [])
    {
        $booking = $this->model()
            ->when(is_array($ignore), fn (QueryBuilder $query) => $query->whereNotIn('id', $ignore), fn (QueryBuilder $query) => $query->where('id', '!=', $ignore))
            ->when($relationships, fn (QueryBuilder $query) => $query->with($relationships));

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

        foreach ($sort as $key => $order) {
            $booking->orderBy($key, $order);
        }

        return $booking->get();
    }

    public function find($id, $with = [], $where = [], $sort = [])
    {
        return $this->model()->where('id', $id)
            ->when(
                $with,
                fn (QueryBuilder $query) => $query->with($with)
            )
            ->when(
                $where,
                fn (QueryBuilder $query) => $query->where($where)
            )
            ->when(
                $sort,
                function (QueryBuilder $query, $sort) {
                    foreach ($sort as $key => $order) {
                        $query->orderBy($key, $order);
                    }
                }
            )->latest()->first();
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

                'bill_for_electricity' => (bool) $inputs['bill_for_electricity'],
                'bill_for_gas' => (bool) $inputs['bill_for_gas'],
                'bill_for_water' => (bool) $inputs['bill_for_water'],

                'comments' => $inputs['comments'],
                'payment' => $inputs['payment'],

                'status' => true,
            ];

            $booking = $this->model()->create($data);

            $booking->tenants()->sync($inputs['tenants'] ?? []);

            if ($inputs['payment'] == 'now') {
                $data = [
                    'booking_id' => null,
                    'payment_method_id' => $inputs['payment_methods'],
                    'customer_id' => $inputs['customer'],
                    'payment_from' => 0,
                    'payment_to' => 0,
                    'credit_amount' => (float)$inputs['advance_payment'],
                    'debit_amount' => 0,
                    'account' => CustomerAccounts::CREDIT_ACCOUNT,
                    'additional_data' => [],
                    'comments' => 'Advance Payment',
                ];

                $this->paymentInterface->model()->create($data);
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
            $booking = $this->model()->find($id);

            $data = [
                'check_out_date' => now()->timestamp,
            ];

            $booking->update($data);

            $this->cabinInterface->setStatus($booking->cabin_id, CabinStatus::NEEDS_CLEANING);

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
