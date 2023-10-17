<?php

namespace App\Services\BookingTaxes;

interface BookingTaxInterface
{
    public function get($ignore = null, $relationships = [], $where = [], $default = false);

    public function find($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);

    public function setDefault($id);
}
