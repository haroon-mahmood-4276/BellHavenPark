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
    use HasFactory, LogsActivity, SoftDeletes, HasUuids;

    protected $dateFormat = 'U';

    protected $fillable = [
        'cabin_id',
        'customer_id',
        'booking_from',
        'booking_to',
        'booking_source_id',
        'daily_rate',
        'daily_less_booking_percentage',
        'weekly_rate',
        'weekly_rate_less_booking_percentage',
        'monthly_rate',
        'monthly_less_booking_percentage',
        'electricity_included',
        'check_in',
        'check_in_date',
        'check_out_date',
        'tax_percentage',
        'tax_rate',
        'status',
        'comments',
        'payment',
    ];

    protected $casts = [
        'cabin_id' => 'uuid',
        'customer_id' => 'uuid',
        'booking_from' => 'date',
        'booking_to' => 'date',
        'booking_source_id' => 'uuid',
        'daily_rate' => 'float',
        'daily_less_booking_percentage' => 'float',
        'weekly_rate' => 'float',
        'weekly_rate_less_booking_percentage' => 'float',
        'monthly_rate' => 'float',
        'monthly_less_booking_percentage' => 'float',
        'electricity_included' => 'boolean',
        'check_in' => 'string',
        'check_in_date' => 'integer',
        'check_out_date' => 'integer',
        'tax_percentage' => 'float',
        'tax_rate' => 'float',
        'status' => 'boolean',
        'comments' => 'string',
        'payment' => 'string',
    ];

    protected $hidden = [];

    protected $appends = ['name'];

    public $rules = [
        'cabin_id' => 'nullable|uuid',
        'customer_id' => 'nullable|uuid',
        'booking_from' => 'nullable|date',
        'booking_to' => 'nullable|date',
        'booking_source_id' => 'nullable|uuid',
        'daily_rate' => 'nullable|float',
        'daily_less_booking_percentage' => 'nullable|float',
        'weekly_rate' => 'nullable|float',
        'weekly_rate_less_booking_percentage' => 'nullable|float',
        'monthly_rate' => 'nullable|float',
        'monthly_less_booking_percentage' => 'nullable|float',
        'electricity_included' => 'nullable|boolean',
        'check_in' => 'string',
        'check_in_date' => 'nullable|date',
        'check_out_date' => 'nullable|date',
        'tax_percentage' => 'nullable|float',
        'tax_rate' => 'nullable|float',
        'status' => 'boolean',
        'comments' => 'string',
        'payment' => 'string|min:3|max:5',
    ];

    public $rulesMessages = [];

    public $rulesAttributes = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    public function cabins()
    {
        return $this->hasOne(Cabin::class);
    }

    public function customers()
    {
        return $this->hasOne(Customer::class);
    }

    public function booking_sources()
    {
        return $this->hasOne(BookingSource::class);
    }
}
