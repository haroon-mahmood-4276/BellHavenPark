<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUuids;

    protected $dateFormat = 'U';

    // protected $keyType = 'string';
    // public $incrementing = false;

    protected $fillable = [
        'name',
        'guard_name',
    ];

    protected $hidden = [
        'guard_name',
    ];

    public $rule = [
        'parent_id' => 'required|uuid',
        'role_name' => 'required|string|between:1,254',
        'guard_name' => 'required|string|between:1,254',
    ];

}
