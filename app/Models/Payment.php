<?php

namespace App\Models;

use App\Utils\Enums\{
    CustomerAccounts,
    PaymentStatus,
    TransactionType,
};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'booking_id',
        'payment_method_id',
        'customer_id',
        'payment_from',
        'payment_to',
        'credit',
        'debit',
        'balance',
        'account',
        'transaction_type',
        'status',
        'comments',
    ];

    protected $casts = [
        'account' => CustomerAccounts::class,
        'payment_from' => 'integer',
        'payment_to' => 'integer',
        'credit' => 'double',
        'debit' => 'double',
        'balance' => 'double',
        'transaction_type' => TransactionType::class,
        'status' => PaymentStatus::class,
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    protected $hidden = [];

    public $rules = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
