<?php

namespace App\Services\PaymentMethods;

use App\Models\PaymentMethod;
use App\Services\PaymentMethods\PaymentMethodInterface;
use Exception;

class PaymentMethodService implements PaymentMethodInterface
{

    public function model()
    {
        return new PaymentMethod();
    }

    public function getById($id)
    {
        $id = decryptParams($id);

        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        try {
            $record = $this->model()->create($inputs);
            return $record;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function update($id, $inputs)
    {
        try {
            $id = decryptParams($id);
            $record = $this->model()->whereId($id)->update($inputs);
            return $record;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function destroy($id)
    {
        try {
            $id = decryptParams($id);

            $this->model()->whereIn('id', $id)->delete();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
