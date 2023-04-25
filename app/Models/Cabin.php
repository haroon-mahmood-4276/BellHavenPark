<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Cabin
 *
 * @property int $id
 * @property int $haven_cabin_type_id
 * @property int $haven_cabin_status_id
 * @property string|null $name
 * @property int|null $long_term
 * @property int|null $electric_meter
 * @property string|null $till
 * @property float $daily_rate
 * @property float $weekly_rate
 * @property float $electric_daily_rate
 * @property float $electric_weekly_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newQuery()
 * @method static \Illuminate\Database\Query\Builder|Cabin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereDailyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereElectricDailyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereElectricMeter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereElectricWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereHavenCabinStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereHavenCabinTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereLongTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereTill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereWeeklyRate($value)
 * @method static \Illuminate\Database\Query\Builder|Cabin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Cabin withoutTrashed()
 * @mixin \Eloquent
 */
class Cabin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_cabins";

    protected $fillable = [
        'haven_cabin_type_id',
        'haven_cabin_status_id',
        'name',
        'long_term',
        'electric_meter',
        'till',
        'daily_rate',
        'weekly_rate',
        'electric_daily_rate',
        'electric_weekly_rate',
    ];

    public function getAll()
    {
        return $this->latest('id')->all();
    }

    public function getAllWithPagination($limit)
    {
        $records = $this->join('haven_cabin_types', 'haven_cabins.haven_cabin_type_id', '=', 'haven_cabin_types.id')
            ->join('haven_cabin_statuses', 'haven_cabins.haven_cabin_status_id', '=', 'haven_cabin_statuses.id')
            ->select('haven_cabins.*', 'haven_cabin_types.name as cabin_type_name', 'haven_cabin_statuses.name as cabin_status_name')
            ->orderBy('id')
            ->paginate($limit);

        return $records;
    }

    public function getAllWithPaginationAndDateRange($dateRange, $limit)
    {

        $bookings = (new Booking())->select('haven_cabin_id')
        ->whereDate('booking_to', '>=', $dateRange[0])
        ->whereDate('booking_from', '<=', (isset($dateRange[2]) ? $dateRange[2] : $dateRange[0]))
        ->where('status', '!=', 'checked_out')
        // ->dd();
        ->get()->toArray();
        $bookings = array_column($bookings, 'haven_cabin_id');
        // dd($bookings);

        $records = $this->join('haven_cabin_types', 'haven_cabins.haven_cabin_type_id', '=', 'haven_cabin_types.id')
        ->join('haven_cabin_statuses', 'haven_cabins.haven_cabin_status_id', '=', 'haven_cabin_statuses.id')
        ->select('haven_cabins.*', 'haven_cabin_types.name as cabin_type_name', 'haven_cabin_statuses.name as cabin_status_name')
        ->whereNotIn('haven_cabins.id', $bookings)
        ->orderBy('haven_cabins.id')
        // ->dd();
        ->paginate($limit);

        // dd($records);

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

    public function storeCabin($request)
    {
        try {
            $data = [
                "haven_cabin_type_id" => filter_strip_tags($request->post('cabin_type')),
                "haven_cabin_status_id" => filter_strip_tags($request->post('cabin_status')),
                "name" => filter_strip_tags($request->post('name')),
                "long_term" => filter_strip_tags($request->post('long_term')),
                "electric_meter" => filter_strip_tags($request->post('electric_meter')),
                "daily_rate" => $request->post('daily_rate'),
                "weekly_rate" => $request->post('weekly_rate'),
            ];

            $result = $this->create($data);

            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateCabin($request, $id)
    {
        try {

            $id = decryptParams($id);

            $data = [
                "haven_cabin_type_id" => filter_strip_tags($request->post('cabin_type')),
                "haven_cabin_status_id" => filter_strip_tags($request->post('cabin_status')),
                "name" => filter_strip_tags($request->post('name')),
                "long_term" => filter_strip_tags($request->post('long_term')),
                "electric_meter" => filter_strip_tags($request->post('electric_meter')),
                "daily_rate" => $request->post('daily_rate'),
                "weekly_rate" => $request->post('weekly_rate'),
            ];

            $result = $this->where('id', $id)->update($data);

            return $result;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroyCabin($id): Exception|bool
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
