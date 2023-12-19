<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

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
        'four_weekly_rate',
        'four_weekly_less_booking_percentage',
        'check_in',
        'check_in_date',
        'check_out_date',
        'booking_tax_id',
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
        'four_weekly_rate' => 'float',
        'four_weekly_less_booking_percentage' => 'float',
        'check_in' => 'string',
        'check_in_date' => 'integer',
        'check_out_date' => 'integer',
        'status' => 'boolean',
        'comments' => 'string',
        'payment' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    protected $hidden = [];

    public $rules = [
        'cabin_id' => 'required|numeric',
        'customer' => 'required|numeric',

        'booking_from' => 'required|integer',
        'booking_to' => 'required|integer',

        'booking_source' => 'nullable|numeric',

        'daily_rate' => 'nullable|numeric',
        'daily_less_booking_percentage' => 'nullable|numeric',

        'weekly_rate' => 'nullable|numeric',
        'weekly_less_booking_percentage' => 'nullable|numeric',

        'four_weekly_rate' => 'nullable|numeric',
        'four_weekly_less_booking_percentage' => 'nullable|numeric',

        'booking_tax' => 'required|integer',
        'check_in' => 'required|in:now,later',

        'payment' => 'required|in:now,later',

        'advance_payment' => 'required_if:payment,now|integer|gte:0',

        'comments' => 'nullable',

        'tenants' => 'nullable|array',
        'tenants.*' => 'nullable|numeric|gte:0',
    ];

    public $rulesMessages = [];

    public $rulesAttributes = [];

    public function __construct()
    {
        parent::boot();

        $this->rules['payment_methods'] = 'required_if:payment,now|integer|exists:payment_methods,id';
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

    public function booking_tax()
    {
        return $this->belongsTo(BookingTax::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'booking_tenants', 'booking_id', 'customer_id');
    }
}
