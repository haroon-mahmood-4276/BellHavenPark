<?php

namespace App\Services\CabinTypes;

use App\Models\CabinType;
use Illuminate\Support\Facades\DB;

class CabinTypeService implements CabinTypeInterface
{
    private function model()
    {
        return new CabinType();
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

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
                'slug' => $inputs['slug'],
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
