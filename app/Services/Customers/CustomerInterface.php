<?php

namespace App\Services\Customers;

interface CustomerInterface
{
    public function get($ignore = null, $relationships = [], $where = []);

    public function find($id, $relationships = [], $where = []);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);

    public function search($search, $ignore_id = 0);

    public function updateCustomerAverageRating($customer_id = 0);
}
