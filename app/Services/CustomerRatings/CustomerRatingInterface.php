<?php

namespace App\Services\CustomerRatings;

interface CustomerRatingInterface
{
    public function get($ignore = null, $relationships = [], $where = []);

    public function getById($id);

    public function store($customer_id, $inputs);
}
