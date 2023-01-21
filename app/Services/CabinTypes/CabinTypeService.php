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

    public function getAll($ignore = null)
    {
        $cabin_type = $this->model();
        if (is_array($ignore)) {
            $cabin_type = $cabin_type->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $cabin_type = $cabin_type->where('id', '!=', $ignore);
        }
        $cabin_type = $cabin_type->get();
        return $cabin_type;
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

            $cabin_type = $this->model()->create($data);
            return $cabin_type;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $cabin_type = $this->model()->find($id)->update($data);
            return $cabin_type;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $cabin_type = $this->model()->whereIn('id', $inputs)->get()->each(function ($cabin_type) {
                $cabin_type->delete();
            });

            return $cabin_type;
        });

        return $returnData;
    }
}
