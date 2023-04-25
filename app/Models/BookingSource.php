<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Exception;

/**
 * App\Models\BookingSource
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource newQuery()
 * @method static \Illuminate\Database\Query\Builder|BookingSource onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|BookingSource withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BookingSource withoutTrashed()
 * @mixin \Eloquent
 */
class BookingSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_booking_sources";

    protected $fillable = [
        'name',
        'description',
    ];

    public function getAll()
    {
        return $this->all();
    }

    public function getAllWithPagination($limit)
    {
        $records = $this->latest()->paginate($limit);
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

    public function storeBookingSource($request)
    {
        try {
            $data = [
                "name" => filter_strip_tags($request->post('name')),
                "description" => filter_strip_tags($request->post('description')),
            ];

            $result = $this->create($data);

            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateBookingSource($request, $id)
    {
        try {
            $id = decryptParams($id);
            $data = [
                "name" => filter_strip_tags($request->post('name')),
                "description" => filter_strip_tags($request->post('description')),
            ];

            $result = $this->where('id', $id)->update($data);

            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroyBookingSource($id): Exception|bool
    {
        try {
            $id = decryptParams($id);
            $result = $this->whereIn('id', $id)->delete();
            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
