<?php

namespace App\Services\CabinStatuses;

interface CabinStatusInterface
{
    public function getAll($ignore = null);

    public function getById($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}