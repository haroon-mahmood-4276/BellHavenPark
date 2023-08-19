<?php

namespace App\Services\CabinAssets;

interface CabinAssetInterface
{
    public function get($ignore = null, $relationships = [], $where = []);

    public function getById($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}
