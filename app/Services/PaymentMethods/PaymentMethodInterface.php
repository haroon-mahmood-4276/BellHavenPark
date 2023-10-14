<?php

namespace App\Services\PaymentMethods;

interface PaymentMethodInterface
{
    public function get($ignore = null, $withoutLinkedAccounts = false);

    public function find($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($inputs);
}
