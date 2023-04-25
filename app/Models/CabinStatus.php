<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

/**
 * App\Models\CabinStatus
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|CabinStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CabinStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CabinStatus withoutTrashed()
 * @mixin \Eloquent
 */
class CabinStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_cabin_statuses";

    protected $fillable = ['name', 'description'];

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

    public function storeCabinStatus($request)
    {
        try {
            $data = [
                "name" => filter_strip_tags($request->post('name')),
                "description" => filter_strip_tags($request->post('description')),
            ];

            // dd($data);

            $result = $this->create($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateCabinStatus($request, $id)
    {
        try {
            $id = decryptParams($id);
            $data = [
                "name" => filter_strip_tags($request->post('name')),
                "description" => filter_strip_tags($request->post('description')),
            ];

            $result = $this->where('id', $id)->update($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroyCabinStatus($id): Exception|bool
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
