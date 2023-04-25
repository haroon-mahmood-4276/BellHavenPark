<?php

namespace App\Services\Bookings;

interface BookingInterface
{
    public function getById($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($id);
}
