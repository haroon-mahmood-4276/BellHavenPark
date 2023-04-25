<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

/**
 * App\Models\InternationalId
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId newQuery()
 * @method static \Illuminate\Database\Query\Builder|InternationalId onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId query()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|InternationalId withTrashed()
 * @method static \Illuminate\Database\Query\Builder|InternationalId withoutTrashed()
 * @mixin \Eloquent
 */
class InternationalId extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_international_ids";

    protected $fillable = ['name'];

    public function getAll()
    {
        return $this->all();
    }

    public function getAllWithPagination($limit)
    {
        return $this->paginate($limit);
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

    public function storeInternationalId($request)
    {
        try {
            $data = [
                'name' => filter_strip_tags($request->name),
            ];

            $result = $this->create($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateInternationalId($request, $id)
    {
        try {
            $id = decryptParams($id);
            $data = [
                'name' => filter_strip_tags($request->name),
            ];

            $result = $this->where('id', $id)->update($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroyInternationalId($id): Exception|bool
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
