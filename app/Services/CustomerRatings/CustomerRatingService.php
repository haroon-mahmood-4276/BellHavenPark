<?php

namespace App\Services\CustomerRatings;

use App\Models\CustomerRating;
use App\Services\Customers\CustomerInterface;
use Illuminate\Support\Facades\DB;

class CustomerRatingService implements CustomerRatingInterface
{
    private $customerInterface;

    public function __construct(CustomerInterface $customerInterface)
    {
        $this->customerInterface = $customerInterface;
    }

    private function model()
    {
        return new CustomerRating();
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

    public function getById($id)
    {
        return $this->model()->find($id);
    }

    public function store($customer_id, $inputs)
    {
        return DB::transaction(function () use ($customer_id, $inputs) {
            $data = [
                'customer_id' => $customer_id,
                'rating' => floatval($inputs['rating']),
                'comments' => $inputs['comments'],
            ];

            $model = $this->model()->create($data);
            $this->customerInterface->updateCustomerAverageRating($customer_id);
            return $model;
        });
    }
}
