<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class InternationalId extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    protected $hidden = [];

    public $rules = [
        'name' => 'required|string|min:1|max:30',
        'slug' => 'required|string|min:1|max:30|unique:international_ids,slug',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }
}
