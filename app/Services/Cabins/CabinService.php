<?php

namespace App\Services\Cabins;

use App\Models\Cabin;
use Illuminate\Support\Facades\DB;

class CabinService implements CabinInterface
{
    private function model()
    {
        return new Cabin();
    }

    public function getAll($ignore = null)
    {
        $cabin = $this->model();
        if (is_array($ignore)) {
            $cabin = $cabin->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $cabin = $cabin->where('id', '!=', $ignore);
        }
        $cabin = $cabin->get();
        return $cabin;
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
                'cabin_status_id' => $inputs['cabin_status'],
                'long_term' => $inputs['long_term'],
                'electric_meter' => $inputs['electric_meter'],
                'daily_rate' => $inputs['daily_rate'],
                'weekly_rate' => $inputs['weekly_rate'],
                'monthly_rate' => $inputs['monthly_rate'],
            ];

            $cabin = $this->model()->create($data);
            return $cabin;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
                'cabin_type_id' => $inputs['cabin_type'],
                'cabin_status_id' => $inputs['cabin_status'],
                'long_term' => $inputs['long_term'],
                'electric_meter' => $inputs['electric_meter'],
                'daily_rate' => $inputs['daily_rate'],
                'weekly_rate' => $inputs['weekly_rate'],
                'monthly_rate' => $inputs['monthly_rate'],
            ];

            $cabin = $this->model()->find($id)->update($data);
            return $cabin;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $cabin = $this->model()->whereIn('id', $inputs)->get()->each(function ($cabin) {
                $cabin->delete();
            });

            return $cabin;
        });

        return $returnData;
    }
}
