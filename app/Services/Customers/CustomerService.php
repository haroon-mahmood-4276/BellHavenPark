<?php

namespace App\Services\Customers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerService implements CustomerInterface
{

    private function model()
    {
        return new Customer();
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

    public function find($id, $relationships = [], $where = [])
    {
        $model = $this->model();

        if ($relationships) {
            $model = $model->with($relationships);
        }

        if ($where) {
            $model = $model->where($where);
        }
        return $model->find($id);
    }

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                "first_name" => $inputs['first_name'],
                "last_name" => $inputs['last_name'],
                "address" => $inputs['address'],
                "email" => $inputs['email'],
                "phone" => $inputs['phone'],
                "dob" => Carbon::parse($inputs['dob'])->timestamp ?? 0,
                "telephone" => $inputs['telephone'],
                "international_id_id" => $inputs['international_id'],
                "international_details" => $inputs['international_details'],
                "international_address" => $inputs['international_address'],
                "comments" => $inputs['comments'],
                "referenced_by" => $inputs['referenced_by'],
                "tenants" => $inputs['tenants'] ?? [],
            ];

            $model = $this->model()->create($data);
            return $model;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                "first_name" => $inputs['first_name'],
                "last_name" => $inputs['last_name'],
                "address" => $inputs['address'],
                "email" => $inputs['email'],
                "phone" => $inputs['phone'],
                "dob" => Carbon::parse($inputs['dob'])->timestamp ?? 0,
                "telephone" => $inputs['telephone'],
                "international_id_id" => $inputs['international_id'],
                "international_details" => $inputs['international_details'],
                "international_address" => $inputs['international_address'],
                "comments" => $inputs['comments'],
                "referenced_by" => $inputs['referenced_by'],
                "tenants" => $inputs['tenants'] ?? [],
            ];

            $model = $this->model()->find($id)->update($data);
            return $model;
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

    public function search($search)
    {
        return $this->model()->search($search)->get();
    }

    public function updateCustomerAverageRating($customer_id = 0)
    {
        $customerArray = [];

        if ($customer_id > 0) $customerArray[] = $this->find(id: $customer_id, relationships: ['ratings']);
        else $customerArray = $this->get(relationships: ['ratings']);

        $customerArray = collect($customerArray)->map(function ($customer) {
            $customer->average_rating = floatval($customer->ratings->sum('rating') / ($customer->ratings->count() > 0 ? $customer->ratings->count() : 1));
            $customer->save();
            return $customer;
        });

        return $customerArray;
    }
}
