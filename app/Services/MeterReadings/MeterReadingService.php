<?php

namespace App\Services\MeterReadings;

use App\Models\MeterReading;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MeterReadingService implements MeterReadingInterface
{
    private function model()
    {
        return new MeterReading();
    }

    public function get($ignore = null, $relationships = [], $where = [])
    {
    }

    public function find($id, $relationships = [], $where = [])
    {
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs) {
            return $this->model()->create([
                'cabin_id' => $inputs['cabin_id'],
                'meter_type' => $inputs['meter_type'],
                'reading' => $inputs['reading'],
                'reading_date' => Carbon::parse($inputs['reading_date'])->timestamp,
                'comments' => $inputs['comments'],
            ]);
        });
    }

    public function update($id, $inputs)
    {
        return DB::transaction(function () use ($id, $inputs) {
            return $this->model()->find($id)->update([
                'meter_type' => $inputs['meter_type'],
                'reading' => $inputs['reading'],
                'reading_date' => Carbon::parse($inputs['reading_date'])->timestamp,
                'comments' => $inputs['comments'],
            ]);
        });
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

    public function previousReading($cabin_id, $meter_type)
    {
        return $this->model()->where([
            ['cabin_id', '=', $cabin_id],
            ['meter_type', '=', $meter_type],
        ])->latest()->first();
    }
}
