<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'haven_payments';

    protected $fillable = [
        'haven_user_id',
        'haven_booking_id',
        'haven_customer_id',
        'payment_credit',
        'payment_debit',
        'payment_balance',
        'status',
        'type',
        'comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'haven_user_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'haven_booking_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'haven_customer_id');
    }
}
