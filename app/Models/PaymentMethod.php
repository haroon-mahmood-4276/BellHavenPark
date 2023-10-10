<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PaymentMethod extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'slug',
        'is_linked_with_credit_account',
    ];

    protected $hidden = [];

    public $rules = [
        'name' => 'required|string|min:1|max:30',
        'slug' => 'required|string|min:1|max:30|unique:payment_methods,slug',
        'is_linked_with_credit_account' => 'required|boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }
}
