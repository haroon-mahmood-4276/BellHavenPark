<?php

namespace App\Services\InternationalIds;

use App\Models\InternationalId;
use Illuminate\Support\Facades\DB;

class InternationalIdService implements InternationalIdInterface
{
    private function model()
    {
        return new InternationalId();
    }

    public function getAll($ignore = null, $with_tree = false)
    {
        $international_id = $this->model();
        if (is_array($ignore)) {
            $international_id = $international_id->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $international_id = $international_id->where('id', '!=', $ignore);
        }
        $international_id = $international_id->get();
        if ($with_tree) {
            return getTreeData(collect($international_id), $this->model());
        }
        return $international_id;
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

            $international_id = $this->model()->create($data);
            return $international_id;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $international_id = $this->model()->find($id)->update($data);
            return $international_id;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $international_id = $this->model()->whereIn('id', $inputs)->get()->each(function ($international_id) {
                $international_id->delete();
            });

            return $international_id;
        });

        return $returnData;
    }
}
