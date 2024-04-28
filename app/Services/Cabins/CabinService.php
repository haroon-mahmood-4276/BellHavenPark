<?php

namespace App\Services\Cabins;

use App\Models\Cabin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CabinService implements CabinInterface
{
    public function model()
    {
        return new Cabin();
    }

    public function getAll($ignore = null, $ignore_status = null)
    {
        $model = $this->model();
        if (is_array($ignore)) {
            $model = $model->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $model = $model->where('id', '!=', $ignore);
        }
        $model = $model->when($ignore_status, function ($query, $ignore_status) {
            if (is_array($ignore_status)) {
                $query->whereNotIn('cabin_status', $ignore_status);
            } else if (is_string($ignore_status)) {
                $query->where('cabin_status', '!=', $ignore_status);
            }
        })->get();
        return $model;
    }

    public function getById(int|array $id)
    {
        $model = $this->model();
        if (is_iterable($id)) {
            return $model->whereIn('id', $id)->get();
        }
        return $model->find($id);
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
                'gas_meter' => $inputs['gas_meter'],
                'water_meter' => $inputs['water_meter'],
                'daily_rate' => $inputs['daily_rate'],
                'weekly_rate' => $inputs['weekly_rate'],
                'four_weekly_rate' => $inputs['four_weekly_rate'],
                'reason' => $inputs['reason'],
                'rooms' => $inputs['rooms'],
                'single_bed' => $inputs['single_bed'],
                'double_bed' => $inputs['double_bed'],
            ];
            switch ($inputs['cabin_status']) {
                    // case 'closed_permanently':
                    //     $data['closed_from'] = intval($inputs['closed_permanent_till']);
                    //     $data['closed_to'] = intval($inputs['closed_permanent_till']);
                    //     break;

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
                'gas_meter' => $inputs['gas_meter'],
                'water_meter' => $inputs['water_meter'],
                'daily_rate' => $inputs['daily_rate'],
                'weekly_rate' => $inputs['weekly_rate'],
                'four_weekly_rate' => $inputs['four_weekly_rate'],
                'reason' => $inputs['reason'],
                'rooms' => $inputs['rooms'],
                'single_bed' => $inputs['single_bed'],
                'double_bed' => $inputs['double_bed'],
            ];
            switch ($inputs['cabin_status']) {
                    // case 'closed_permanently':
                    //     $data['closed_from'] = intval($inputs['closed_permanent_till']);
                    //     $data['closed_to'] = intval($inputs['closed_permanent_till']);
                    //     break;

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

    public function setStatus(int|array $id, $status, $reason = '')
    {
        return DB::transaction(function () use ($id, $status, $reason) {
            $data = ['cabin_status' => $status, 'reason' => $reason];
            if (is_iterable($id)) {
                return $this->getById($id)->each->update($data);
            }
            return $this->getById($id)->update($data);
        });
    }

    public function search($search, $per_page = 15, $ignore_ids = [])
    {
        $model = $this->model()
            ->where(function (QueryBuilder $query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
            })
            ->when(count($ignore_ids) > 0, fn (QueryBuilder $query) => $query->whereNotIn('id', $ignore_ids));

        return $model->simplePaginate($per_page);
    }
}
