<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTax extends Model
{
    use SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'amount',
        'is_flat',
        'is_default',
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public $rules = [
        'name' => 'required|string|min:1|max:30',
        'amount' => 'required|numeric|min:0|max:100',
        'is_flat' => 'required|boolean',
        'is_default' => 'required|boolean',
    ];
}
