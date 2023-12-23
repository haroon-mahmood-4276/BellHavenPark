<?php

namespace App\Services\Cabins;

interface CabinInterface
{

    public function model();

    public function getAll($ignore = null);

    public function getById(int|array $id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
    
    public function setStatus(int|array $id, $status);
}
