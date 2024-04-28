<?php

namespace App\Models;

use App\Utils\Enums\CabinStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cabin extends Model
{
    use SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'cabin_type_id',
        'cabin_status',
        'closed_from',
        'closed_to',
        'long_term',
        'electric_meter',
        'gas_meter',
        'water_meter',
        'daily_rate',
        'weekly_rate',
        'four_weekly_rate',
        'reason',

        'rooms',
        'single_bed',
        'double_bed',
    ];

    protected $casts = [
        'cabin_status' => CabinStatus::class,

        'rooms' => 'integer',
        'single_bed' => 'integer',
        'double_bed' => 'integer',

        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public $rules = [
        'name' => 'required|string|between:3,50',
        'cabin_type' => 'required|numeric|gte:0',
        'closed_permanent_till' => 'nullable|numeric|gte:0',
        'closed_temporarily_till_from' => 'required|numeric|gte:0',
        'closed_temporarily_till_to' => 'required|numeric|gte:0',
        'long_term' => 'required|boolean',
        'electric_meter' => 'required|boolean',
        'gas_meter' => 'required|boolean',
        'water_meter' => 'required|boolean',
        'daily_rate' => 'required|numeric|gt:-1',
        'weekly_rate' => 'required|numeric|gt:-1',
        'four_weekly_rate' => 'required|numeric|gt:-1',
        'rooms' => 'required|numeric|gt:-1',
        'single_bed' => 'required|numeric|gt:-1',
        'double_bed' => 'required|numeric|gt:-1',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->rules['cabin_status'] = 'required|string|in:' . implode(',', CabinStatus::values());
        $this->rules['reason'] = 'required_if:cabin_status,' . implode(',', [CabinStatus::CLOSED_PERMANENTLY->value, CabinStatus::CLOSED_TEMPORARILY->value, CabinStatus::MAINTENANCE->value]);
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
