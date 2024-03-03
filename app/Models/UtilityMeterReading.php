<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UtilityMeterReading extends Model
{
    use SoftDeletes, HasFactory;

    protected $dateFormat = 'U';

    protected $fillable = [
        //
    ];

    protected $casts = [
        //

        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public $rules = [
        //
    ];
}