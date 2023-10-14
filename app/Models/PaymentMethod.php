<?php

namespace App\Models;

use App\Utils\Enums\CustomerAccounts;
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
        'linked_account',
    ];

    protected $hidden = [];

    protected $casts = [
        'linked_account' => CustomerAccounts::class
    ];

    public $rules = [
        'name' => 'required|string|min:1|max:30',
        'slug' => 'required|string|min:1|max:30|unique:payment_methods,slug',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    public function __construct()
    {
        parent::boot();

        $this->rules['linked_account'] = 'nullable|in:' . implode(',', CustomerAccounts::values());
    }
}
