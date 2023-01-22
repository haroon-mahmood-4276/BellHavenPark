<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUuids, HasFactory, LogsActivity;

    protected $dateFormat = 'U';

    protected $fillable = [
        'parent_id',
        'name',
        'guard_name',
    ];

    protected $hidden = [
        'guard_name',
    ];

    public $rules = [
        'parent_id' => 'required|uuid',
        'name' => 'required|string|between:1,254',
        'guard_name' => 'required|string|between:1,254',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }
}
