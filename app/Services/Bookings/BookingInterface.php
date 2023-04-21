<?php

namespace App\Services\Bookings;

interface BookingInterface
{
    public function getAll($ignore = null);

    public function getById($id, $relationships = []);

    public function getBookedCabinsWithinDates($start_date, $end_date);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}
