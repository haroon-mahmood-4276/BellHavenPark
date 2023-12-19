<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    protected $dateFormat = 'U';

    protected $fillable = [
        'parent_id',
        'name',
        'guard_name',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    protected $hidden = [
        'guard_name',
    ];

    public $rules = [
        'parent_id' => 'required|numeric|gte:0',
        'name' => 'required|string|between:1,254',
        'guard_name' => 'required|string|between:1,254',
    ];
}
