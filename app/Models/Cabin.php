<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Cabin extends Model
{
    use HasFactory, LogsActivity, HasUuids, SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'long_term',
        'electric_meter',
        'till',
        'daily_rate',
        'weekly_rate',
        'electric_daily_rate',
        'electric_weekly_rate',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }
}
