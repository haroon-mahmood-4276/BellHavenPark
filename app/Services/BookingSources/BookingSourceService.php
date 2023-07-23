<?php

namespace App\Services\BookingSources;

use App\Models\BookingSource;
use Illuminate\Support\Facades\DB;

class BookingSourceService implements BookingSourceInterface
{
    private function model()
    {
        return new BookingSource();
    }

    public function getAll($ignore = null, $with_tree = false)
    {
        $model = $this->model();
        if (is_array($ignore)) {
            $model = $model->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $model = $model->where('id', '!=', $ignore);
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
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
                'description' => $inputs['description'],
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
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
                'description' => $inputs['description'],
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
}
