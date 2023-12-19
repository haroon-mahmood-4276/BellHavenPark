<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingSource extends Model
{
    use SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public $rules = [
        'name' => "required|string|between:1,50",
        'slug' => 'required|string|min:1|max:50|unique:booking_sources,slug',
        'description' => "nullable|string|between:1,254",
    ];
}
