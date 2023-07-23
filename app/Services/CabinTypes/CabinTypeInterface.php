<?php

namespace App\Services\CabinTypes;

interface CabinTypeInterface
{
    public function get($ignore = null, $relationships = [], $where = []);

    public function getById($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}
