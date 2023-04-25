<?php

namespace App\Services\PaymentMethods;

interface PaymentMethodInterface
{
    public function getById($id);

    public function store($inputs);

    public function update($id, $inputs);

    public function destroy($id);
}
