<?php

namespace App\Services\PaymentMethods;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class PaymentMethodService implements PaymentMethodInterface
{
    private function model()
    {
        return new PaymentMethod();
    }

    public function getAll($ignore = null, $with_tree = false)
    {
        $payment_method = $this->model();
        if (is_array($ignore)) {
            $payment_method = $payment_method->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $payment_method = $payment_method->where('id', '!=', $ignore);
        }
        $payment_method = $payment_method->get();
        if ($with_tree) {
            return getTreeData(collect($payment_method), $this->model());
        }
        return $payment_method;
    }

    public function getById($id)
    {
        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $payment_method = $this->model()->create($data);
            return $payment_method;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $payment_method = $this->model()->find($id)->update($data);
            return $payment_method;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $payment_method = $this->model()->whereIn('id', $inputs)->get()->each(function ($payment_method) {
                $payment_method->delete();
            });

            return $payment_method;
        });

        return $returnData;
    }
}