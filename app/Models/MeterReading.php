<?php

namespace App\Models;

use App\Utils\Enums\MeterTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeterReading extends Model
{
    use SoftDeletes, HasFactory;

    protected $dateFormat = 'U';

    protected $fillable = [
        'cabin_id',
        'meter_type',
        'reading_date',
        'reading',
        'comments',
    ];

    protected $casts = [
        'reading' => 'integer',
        'meter_type' => MeterTypes::class,
        'reading_date' => 'timestamp',

        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public $rules = [
        'cabin_id' => 'required|exists:cabins,id',
        'reading' => 'required|gt:0|max:' . PHP_INT_MAX,
        'reading_date' => 'required|date',
        'comments' => 'nullable',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->rules['meter_type'] = 'required|string|in:' . implode(',', MeterTypes::values());
    }

    public function cabin()
    {
        return $this->belongsTo(Cabin::class);
    }
}
