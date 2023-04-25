<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Booking
 *
 * @property int $id
 * @property int|null $haven_cabin_id
 * @property int|null $haven_customer_id
 * @property string|null $booking_from
 * @property string|null $booking_to
 * @property int|null $haven_booking_source_id
 * @property int|null $daily_rate
 * @property int|null $daily_less_booking_percentage
 * @property int|null $weekly_rate
 * @property int|null $weekly_rate_less_booking_percentage
 * @property int|null $four_weekly_rate
 * @property int|null $four_weekly_less_booking_percentage
 * @property int|null $electricity_included
 * @property string|null $check_in
 * @property string|null $check_in_date
 * @property string|null $check_out_date
 * @property float|null $tax_percentage
 * @property float|null $tax_rate
 * @property int|null $booking_source
 * @property string|null $status
 * @property string|null $comments
 * @property string|null $payment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Query\Builder|Booking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckInDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckOutDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDailyLessBookingPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDailyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereElectricityIncluded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFourWeeklyLessBookingPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFourWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereHavenBookingSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereHavenCabinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereHavenCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTaxPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereWeeklyRateLessBookingPercentage($value)
 * @method static \Illuminate\Database\Query\Builder|Booking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Booking withoutTrashed()
 * @mixin \Eloquent
 */
class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'haven_bookings';

    protected $fillable = [
        'haven_cabin_id',
        'haven_customer_id',
        'booking_from',
        'booking_to',
        'haven_booking_source_id',
        'daily_rate',
        'daily_less_booking_percentage',
        'weekly_rate',
        'weekly_rate_less_booking_percentage',
        'four_weekly_rate',
        'four_weekly_less_booking_percentage',
        'electricity_included',
        'check_in',
        'check_in_date',
        'check_out_date',
        'tax_percentage',
        'tax_rate',
        'booking_source',
        'status',
        'comments',
        'payment',
    ];


    public function getAll()
    {
        return $this->all();
    }

    public function getAllLatest()
    {
        return $this->latest('id')->all();
    }

    public function getAllWithPagination($limit)
    {
        $records = $this->leftJoin('haven_customers', 'haven_bookings.haven_customer_id', '=', 'haven_customers.id')
            ->leftJoin('haven_cabins', 'haven_bookings.haven_cabin_id', '=', 'haven_cabins.id')
            ->leftJoin('haven_booking_sources', 'haven_bookings.haven_booking_source_id', '=', 'haven_booking_sources.id')
            ->select('haven_bookings.*', 'haven_customers.first_name AS customer_first_name', 'haven_customers.last_name AS customer_last_name', 'haven_cabins.name AS cabin_name', 'haven_booking_sources.name AS booking_source_name')
            ->latest()
            ->orderBy('id')->paginate($limit);

        return $records;
    }

    public function getAllWithPaginationAndDateRange($dateRange, $limit)
    {
        $records = $this->join('haven_cabin_types', 'haven_cabins.haven_cabin_type_id', '=', 'haven_cabin_types.id')
            ->join('haven_cabin_statuses', 'haven_cabins.haven_cabin_status_id', '=', 'haven_cabin_statuses.id')
            ->select('haven_cabins.*', 'haven_cabin_types.name as cabin_type_name', 'haven_cabin_statuses.name as cabin_status_name')
            ->orderBy('id')
            ->paginate($limit);

        return $records;
    }

    public function getById($id)
    {
        try {
            $id = decryptParams($id);
            if($record = $this->where('id', $id)->first()){
                return $record;
            }
            return null;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getAllCheckInWithPagination($limit)
    {
        $records = $this->leftJoin('haven_customers', 'haven_bookings.haven_customer_id', '=', 'haven_customers.id')
            ->leftJoin('haven_cabins', 'haven_bookings.haven_cabin_id', '=', 'haven_cabins.id')
            ->leftJoin('haven_booking_sources', 'haven_bookings.haven_booking_source_id', '=', 'haven_booking_sources.id')
            ->select('haven_bookings.*', 'haven_customers.first_name AS customer_first_name', 'haven_customers.last_name AS customer_last_name', 'haven_cabins.name AS cabin_name', 'haven_booking_sources.name AS booking_source_name')
            ->whereNull('check_in_date')
            ->whereNull('check_out_date')
            ->orderBy('id')->paginate($limit);

        return $records;
    }

    public function getAllCheckOutWithPagination($limit)
    {
        $records = $this->leftJoin('haven_customers', 'haven_bookings.haven_customer_id', '=', 'haven_customers.id')
            ->leftJoin('haven_cabins', 'haven_bookings.haven_cabin_id', '=', 'haven_cabins.id')
            ->leftJoin('haven_booking_sources', 'haven_bookings.haven_booking_source_id', '=', 'haven_booking_sources.id')
            ->select('haven_bookings.*', 'haven_customers.first_name AS customer_first_name', 'haven_customers.last_name AS customer_last_name', 'haven_cabins.name AS cabin_name', 'haven_booking_sources.name AS booking_source_name')
            ->whereNotNull('check_in_date')
            ->whereNull('check_out_date')
            ->orderBy('id')->paginate($limit);

        return $records;
    }

    public function storeBookingCheckIn($request, $booking_id)
    {
        try {
            $data = [
                'check_in_date' => now(),
                'status' => 'waiting_for_check_out'
            ];

            $this->where('id', $booking_id)->update($data);
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function storeBookingCheckOut($request, $booking_id)
    {
        try {
            $data = [
                'check_out_date' => now(),
                'status' => 'checked_out'
            ];

            $this->where('id', $booking_id)->update($data);
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
