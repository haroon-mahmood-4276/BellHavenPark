<?php

namespace App\Services\MeterReadings;

interface MeterReadingInterface
{
    public function get($ignore = null, $relationships = [], $where = []);

    public function find($id, $relationships = [], $where = []);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);

    public function previousReading($cabin_id, $meter_type);
}
