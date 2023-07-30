<?php

namespace App\Services\Settings;

use App\Models\Setting;
use App\Services\Settings\SettingInterface;
use Illuminate\Support\Facades\DB;

class SettingService implements SettingInterface
{
    private function model()
    {
        return new Setting();
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
        if ($with_tree) {
            return getTreeData(collect($model), $this->model());
        }
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
                'guard_name' => $inputs['guard_name'],
                'parent_id' => $inputs['parent_id'],
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
                'guard_name' => $inputs['guard_name'],
                'parent_id' => $inputs['parent_id'],
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
