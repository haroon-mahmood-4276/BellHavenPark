<?php

namespace App\Services\BookingTaxes;

use App\Models\BookingTax;
use Illuminate\Support\Facades\DB;

class BookingTaxService implements BookingTaxInterface
{
    private function model()
    {
        return new BookingTax();
    }

    public function get($ignore = null, $relationships = [], $where = [])
    {
        $model = $this->model();
        if (is_array($ignore)) {
            $model = $model->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $model = $model->where('id', '!=', $ignore);
        }

        if ($relationships) {
            $model = $model->with($relationships);
        }

        if ($where) {
            $model = $model->where($where);
        }

        $model = $model->get();
        return $model;
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs) {
            $this->model()->where('is_default', true)->update(['is_default' => false]);
            $data = [
                'name' => $inputs['name'],
                'amount' => (int)$inputs['amount'],
                'is_flat' => (boolean)$inputs['is_flat'],
                'is_default' => (boolean)$inputs['is_default'],
            ];

            $model = $this->model()->create($data);
            return $model;
        });
    }

    public function update($id, $inputs)
    {
        return DB::transaction(function () use ($id, $inputs) {
            $this->model()->where('is_default', true)->update(['is_default' => false]);
            $data = [
                'name' => $inputs['name'],
                'amount' => (int)$inputs['amount'],
                'is_flat' => (boolean)$inputs['is_flat'],
                'is_default' => (boolean)$inputs['is_default'],
            ];

            $model = $this->model()->find($id)->update($data);
            return $model;
        });
    }

    public function destroy($inputs)
    {
        return DB::transaction(function () use ($inputs) {

            $model = $this->model()->whereIn('id', $inputs)->get()->each(function ($model) {
                $model->delete();
            });

            $this->model()->first()->update(['is_default' => true]);

            return $model;
        });
    }

    public function setDefault($id)
    {
        return DB::transaction(function () use ($id) {
            $model = $this->model()->where('is_default', true)->update(['is_default' => false]);
            $model = $this->model()->find($id)->update(['is_default' => true]);
            return $model;
        });
    }
}
