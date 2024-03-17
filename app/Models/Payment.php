<?php

namespace App\Models;

use App\Utils\Enums\{
    CustomerAccounts,
    PaymentStatus,
    PaymentType,
    TransactionType,
};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'booking_id',
        'payment_method_id',
        'customer_id',
        'payment_from',
        'payment_to',
        'amount',
        'account',
        'transaction_type',
        'status',
        'payment_type',
        'additional_data',
        'comments',
    ];

    protected $casts = [
        'account' => CustomerAccounts::class,
        
        'amount' => 'double',
        
        'balance' => 'double',
        
        'payment_from' => 'timestamp',
        'payment_to' => 'timestamp',
        
        'transaction_type' => TransactionType::class,
        'status' => PaymentStatus::class,
        
        'additional_data' => 'array',

        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
        
        'payment_type' => PaymentType::class,
    ];

    protected $hidden = [];

    public $rules = [];

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
