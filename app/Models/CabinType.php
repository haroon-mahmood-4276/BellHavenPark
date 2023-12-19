<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CabinType extends Model
{
    use SoftDeletes;

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
        'slug' => 'required|string|min:1|max:30|unique:cabin_types,slug',
    ];
    
    public function cabins(): HasMany
    {
        return $this->hasMany(Cabin::class);
    }
}
