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
        'cabin_type_id',
        'cabin_status_id',
        'long_term',
        'electric_meter',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
    ];

    public $rules = [
        'name' => 'required|string|between:3,50',
        'cabin_type' => 'required|uuid',
        'cabin_status' => 'required|uuid',
        'long_term' => 'required|boolean',
        'electric_meter' => 'required|boolean',
        'daily_rate' => 'required|numeric|gt:-1',
        'weekly_rate' => 'required|numeric|gt:-1',
        'monthly_rate' => 'required|numeric|gt:-1',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    public function cabin_type()
    {
        return $this->belongsTo(CabinType::class);
    }

    public function cabin_status()
    {
        return $this->belongsTo(CabinStatus::class);
    }
}
