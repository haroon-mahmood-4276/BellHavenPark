<?php

namespace App\Services\Bookings;

interface BookingInterface
{
    public function get($ignore = null, $relationships = [], $only = []);

    public function getById($id, $relationships = []);

    public function getBookedCabinsWithinDates($start_date, $end_date);

    public function store($inputs);

    public function storeCheckIn($id);

    public function storeCheckout($id);

    public function update($id, $inputs);

    public function destroy($inputs);
}
