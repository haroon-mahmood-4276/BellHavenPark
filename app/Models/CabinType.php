<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

/**
 * App\Models\CabinType
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType newQuery()
 * @method static \Illuminate\Database\Query\Builder|CabinType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CabinType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CabinType withoutTrashed()
 * @mixin \Eloquent
 */
class CabinType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_cabin_types";

    protected $fillable = ['name', 'rate'];

    public function getAll()
    {
        return $this->all();
    }

    public function getAllWithPagination($limit)
    {
        $records = $this->paginate($limit);
        return $records;
    }

    public function getById($id)
    {
        try {
            $id = decryptParams($id);
            return $this->where('id', $id)->first();
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function storeCabinType($request)
    {
        try {
            $data = [
                "name" => filter_strip_tags($request->post('name')),
                // "rate" => $request->post('rate'),
                "rate" => 0,
            ];

            // dd($data);

            $result = $this->create($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateCabinType($request, $id)
    {
        try {
            $id = decryptParams($id);
            $data = [
                "name" => filter_strip_tags($request->post('name')),
                // "rate" => $request->post('rate'),
                "rate" => 0,
            ];

            $result = $this->where('id', $id)->update($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroyCabinType($id): Exception|bool
    {
        try {
            $id = decryptParams($id);
            $this->whereIn('id', $id)->delete();
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }


}
