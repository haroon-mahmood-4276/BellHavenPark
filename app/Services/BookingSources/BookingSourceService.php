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
        $bookingSource = $this->model();
        if (is_array($ignore)) {
            $bookingSource = $bookingSource->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $bookingSource = $bookingSource->where('id', '!=', $ignore);
        }
        $bookingSource = $bookingSource->get();
        return $bookingSource;
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
                'description' => $inputs['description'],
            ];

            $bookingSource = $this->model()->create($data);
            return $bookingSource;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
                'description' => $inputs['description'],
            ];

            $bookingSource = $this->model()->find($id)->update($data);
            return $bookingSource;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $bookingSource = $this->model()->whereIn('id', $inputs)->get()->each(function ($bookingSource) {
                $bookingSource->delete();
            });

            return $bookingSource;
        });

        return $returnData;
    }
}
