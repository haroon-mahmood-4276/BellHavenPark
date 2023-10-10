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

    public function getAll($ignore = null)
    {
        $model = $this->model();
        if (is_array($ignore)) {
            $model = $model->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $model = $model->where('id', '!=', $ignore);
        }

        return $model->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $this->model()->where('is_linked_with_credit_account', true)->update(['is_linked_with_credit_account' => false]);
            $data = [
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
                'is_linked_with_credit_account' => $inputs['is_linked_with_credit_account'],
            ];

            return $this->model()->create($data);
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $this->model()->where('is_linked_with_credit_account', true)->update(['is_linked_with_credit_account' => false]);
            $data = [
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
                'is_linked_with_credit_account' => $inputs['is_linked_with_credit_account'],
            ];

            return $this->model()->find($id)->update($data);
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $model = $this->model()->whereIn('id', $inputs)->get()->each(function ($model) {
                $model->delete();
            });

            return $model;
        });

        return $returnData;
    }

    public function setDefault($id)
    {
        return DB::transaction(function () use ($id) {
            $model = $this->model()->where('is_linked_with_credit_account', true)->update(['is_linked_with_credit_account' => false]);
            $model = $this->model()->find($id)->update(['is_linked_with_credit_account' => true]);
            return $model;
        });
    }
}
