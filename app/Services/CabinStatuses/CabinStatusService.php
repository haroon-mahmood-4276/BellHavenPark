<?php

namespace App\Services\CabinStatuses;

use App\Models\CabinStatus;
use Illuminate\Support\Facades\DB;

class CabinStatusService implements CabinStatusInterface
{
    private function model()
    {
        return new CabinStatus();
    }

    public function getAll($ignore = null)
    {
        $cabin_status = $this->model();
        if (is_array($ignore)) {
            $cabin_status = $cabin_status->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $cabin_status = $cabin_status->where('id', '!=', $ignore);
        }
        $cabin_status = $cabin_status->get();
        return $cabin_status;
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

            $cabin_status = $this->model()->create($data);
            return $cabin_status;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
            ];

            $cabin_status = $this->model()->find($id)->update($data);
            return $cabin_status;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $cabin_status = $this->model()->whereIn('id', $inputs)->get()->each(function ($cabin_status) {
                $cabin_status->delete();
            });

            return $cabin_status;
        });

        return $returnData;
    }
}
