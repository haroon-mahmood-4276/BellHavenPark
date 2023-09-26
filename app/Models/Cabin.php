<?php

namespace App\Models;

use App\Utils\Enums\CabinStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Cabin extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'cabin_type_id',
        'cabin_status',
        'closed_from',
        'closed_to',
        'long_term',
        'electric_meter',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
    ];

    protected $casts = [
        'cabin_status' => CabinStatus::class
    ];

    public $rules = [
        'name' => 'required|string|between:3,50',
        'cabin_type' => 'required|numeric|gte:0',
        'closed_permanent_till' => 'required|numeric|gte:0',
        'closed_temporarily_till_from' => 'required|numeric|gte:0',
        'closed_temporarily_till_to' => 'required|numeric|gte:0',
        'long_term' => 'required|boolean',
        'electric_meter' => 'required|boolean',
        'daily_rate' => 'required|numeric|gt:-1',
        'weekly_rate' => 'required|numeric|gt:-1',
        'monthly_rate' => 'required|numeric|gt:-1',
    ];

    public function __construct()
    {
        parent::boot();

        $this->rules['cabin_status'] = 'required|string|in:' . implode(',', CabinStatus::values());
    }

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

    public function assets()
    {
        return $this->belongsToMany(CabinAsset::class);
    }
}
