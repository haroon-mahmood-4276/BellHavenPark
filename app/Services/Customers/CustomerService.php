<?php

namespace App\Services\Customers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerService implements CustomerInterface
{
    private function model()
    {
        return new Customer();
    }

    public function getAll($ignore = null)
    {
        $customer = $this->model();
        if (is_array($ignore)) {
            $customer = $customer->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $customer = $customer->where('id', '!=', $ignore);
        }
        $customer = $customer->get();
        return $customer;
    }

    public function getById($id)
    {
        return $this->model()->find($id);
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
                "dob" => $inputs['dob'] ?? 0,
                "telephone" => $inputs['telephone'],
                "international_id_id" => $inputs['international_id'],
                "international_details" => $inputs['international_details'],
                "international_address" => $inputs['international_address'],
                "comments" => $inputs['comments'],
                "referenced_by" => $inputs['referenced_by'],
                "tenants" => $inputs['tenants'] ?? [],
            ];

            $customer = $this->model()->create($data);
            return $customer;
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
                "dob" => $inputs['dob'] ?? 0,
                "telephone" => $inputs['telephone'],
                "international_id_id" => $inputs['international_id'],
                "international_details" => $inputs['international_details'],
                "international_address" => $inputs['international_address'],
                "comments" => $inputs['comments'],
                "referenced_by" => $inputs['referenced_by'],
                "tenants" => $inputs['tenants'] ?? [],
            ];

            $customer = $this->model()->find($id)->update($data);
            return $customer;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $customer = $this->model()->whereIn('id', $inputs)->get()->each(function ($customer) {
                $customer->delete();
            });

            return $customer;
        });

        return $returnData;
    }
}
