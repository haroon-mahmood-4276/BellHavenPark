<?php

namespace App\Services\Cabins;

use App\Models\Cabin;
use Illuminate\Support\Facades\DB;

class CabinService implements CabinInterface
{
    public function model()
    {
        return new Cabin();
    }

    public function getAll($ignore = null)
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

    public function getById($id)
    {
        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
                'cabin_type_id' => $inputs['cabin_type'],
                'cabin_status' => $inputs['cabin_status'],
                'long_term' => $inputs['long_term'],
                'electric_meter' => $inputs['electric_meter'],
                'daily_rate' => $inputs['daily_rate'],
                'weekly_rate' => $inputs['weekly_rate'],
                'four_weekly_rate' => $inputs['four_weekly_rate'],
            ];
            switch ($inputs['cabin_status']) {
                case 'closed_permanently':
                    $data['closed_from'] = intval($inputs['closed_permanent_till']);
                    $data['closed_to'] = intval($inputs['closed_permanent_till']);
                    break;

                case 'closed_temporarily':
                    $data['closed_from'] = intval($inputs['closed_temporarily_till_from']);
                    $data['closed_to'] = intval($inputs['closed_temporarily_till_to']);
                    break;
            }

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
                'cabin_type_id' => $inputs['cabin_type'],
                'cabin_status' => $inputs['cabin_status'],
                'long_term' => $inputs['long_term'],
                'electric_meter' => $inputs['electric_meter'],
                'daily_rate' => $inputs['daily_rate'],
                'weekly_rate' => $inputs['weekly_rate'],
                'four_weekly_rate' => $inputs['four_weekly_rate'],
            ];
            switch ($inputs['cabin_status']) {
                case 'closed_permanently':
                    $data['closed_from'] = intval($inputs['closed_permanent_till']);
                    $data['closed_to'] = intval($inputs['closed_permanent_till']);
                    break;

                case 'closed_temporarily':
                    $data['closed_from'] = intval($inputs['closed_temporarily_till_from']);
                    $data['closed_to'] = intval($inputs['closed_temporarily_till_to']);
                    break;
            }

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

    public function setStatus($id, $status)
    {
        return DB::transaction(function () use ($id, $status) {
            return $this->getById($id)->update(['cabin_status' => $status]);
        });
    }
}
