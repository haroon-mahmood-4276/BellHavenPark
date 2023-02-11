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
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
                'description' => $inputs['description'],
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
