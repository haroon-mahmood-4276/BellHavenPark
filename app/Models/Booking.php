<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Booking extends Model
{
    use LogsActivity, SoftDeletes, HasUuids;

    protected $dateFormat = 'U';

    protected $fillable = [
        'cabin_id',
        'customer_id',
        'booking_number',
        'booking_from',
        'booking_to',
        'booking_source_id',
        'daily_rate',
        'daily_less_booking_percentage',
        'weekly_rate',
        'weekly_rate_less_booking_percentage',
        'monthly_rate',
        'monthly_less_booking_percentage',
        'check_in',
        'check_in_date',
        'check_out_date',
        'tax',
        'status',
        'comments',
        'payment',
    ];

    protected $casts = [
        'booking_number' => 'integer',
        'booking_from' => 'date',
        'booking_to' => 'date',
        'daily_rate' => 'float',
        'daily_less_booking_percentage' => 'float',
        'weekly_rate' => 'float',
        'weekly_rate_less_booking_percentage' => 'float',
        'monthly_rate' => 'float',
        'monthly_less_booking_percentage' => 'float',
        'check_in' => 'string',
        'check_in_date' => 'integer',
        'check_out_date' => 'integer',
        'tax' => 'float',
        'status' => 'boolean',
        'comments' => 'string',
        'payment' => 'string',
    ];

    protected $hidden = [];

    public $rules = [
        'cabin_id' => 'required|uuid',
        'customer' => 'required|uuid',
        'booking_from' => 'required|integer',
        'booking_to' => 'required|integer',
        'booking_source' => 'nullable|uuid',
        'daily_rate' => 'nullable|numeric',
        'daily_less_booking_percentage' => 'nullable|numeric',
        'weekly_rate' => 'nullable|numeric',
        'weekly_less_booking_percentage' => 'nullable|numeric',
        'monthly_rate' => 'nullable|numeric',
        'monthly_less_booking_percentage' => 'nullable|numeric',
        'booking_tax' => 'nullable|integer',
        'check_in' => 'required|in:now,later',
        'payment' => 'required|in:now,later',
        'advance_payment' => 'required_if:payment,now|integer|gt:-1',
        'comments' => 'nullable|text'
    ];

    public $rulesMessages = [];

    public $rulesAttributes = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    public function cabin()
    {
        return $this->belongsTo(Cabin::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function booking_source()
    {
        return $this->belongsTo(BookingSource::class);
    }
}
