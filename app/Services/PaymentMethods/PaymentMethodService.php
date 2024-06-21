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

    public function get($ignore = null, $withoutLinkedAccounts = false)
    {
        $model = $this->model();
        if (is_array($ignore)) {
            $model = $model->whereNotIn('id', $ignore);
        } elseif (is_string($ignore)) {
            $model = $model->where('id', '!=', $ignore);
        }

        if ($withoutLinkedAccounts) {
            $model = $model->whereNull('linked_account');
        }

        return $model->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs) {
            $this->model()->where('linked_account', $inputs['linked_account'])->first()->update(['linked_account' => null]);

            $data = [
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
                'linked_account' => $inputs['linked_account'],
            ];

            return $this->model()->create($data);
        });
    }

    public function update($id, $inputs)
    {
        return DB::transaction(function () use ($id, $inputs) {
            $this->model()->where('linked_account', $inputs['linked_account'])->first()?->update(['linked_account' => null]);
            $data = [
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
                'linked_account' => $inputs['linked_account'],
            ];

            return $this->model()->find($id)->update($data);
        });
    }

    public function destroy($inputs)
    {
        return DB::transaction(function () use ($inputs) {
            return $this->model()->whereIn('id', $inputs)->delete();
        });
    }
}
