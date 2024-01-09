<?php

namespace App\Services\Cabins;

use App\Utils\Enums\CabinStatus;

interface CabinInterface
{

    public function model();

    public function getAll($ignore = null, $ignore_status = null);

    public function getById(int|array $id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
    
    public function setStatus(int|array $id, $status, $reason = '');
}
