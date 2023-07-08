<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BookingSource extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'description',
    ];

    public $rules = [
        'name' => "required|string|between:1,50",
        'description' => "nullable|string|between:1,254",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }
}
