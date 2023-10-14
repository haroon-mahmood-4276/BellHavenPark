<?php

namespace App\Services\PaymentMethods;

interface PaymentMethodInterface
{
    public function getAll($ignore = null);

    public function find($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}
