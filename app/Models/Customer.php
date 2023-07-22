<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, Searchable;

    protected $dateFormat = 'U';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'dob',
        'phone',
        'telephone',
        'international_id_id',
        'international_details',
        'international_address',
        'comments',
        'address',
        'referenced_by',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    protected $hidden = [];

    protected $appends = ['name', 'average_rating'];

    public $rules = [
        'first_name' => 'required|string|min:3|max:50',
        'last_name' => 'required|string|min:3|max:50',
        'email' => 'nullable|email|min:1|max:250',
        'dob' => 'nullable|date',
        'phone' => 'required|numeric|min_digits:3|max_digits:20',
        'telephone' => 'nullable|numeric|min_digits:3|max_digits:20',
        'international_id' => 'nullable|uuid',
        'international_details' => 'nullable|string|min:3|max:50',
        'international_address' => 'nullable|string|min:3|max:50',
        'comments' => 'nullable|string|min:3,max:250',
        'address' => 'nullable|string|min:3,max:250',
        'referenced_by' => 'nullable|string|min:3|max:50',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ucfirst($attributes['first_name'] ?? "") . ' ' . ucfirst($attributes['last_name'] ?? ""),
            set: function ($value, $attributes) {
                $attributes['first_name'] = $value;
                $attributes['last_name'] = $value;
            },
        );
    }

    protected function tenants(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = array_map(function ($tenant) {
                    $tenant['tenant_dob'] = strtotime($tenant['tenant_dob']);
                    return $tenant;
                }, $value);
                return json_encode($value);
            }
        );
    }

    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $ratings = $this->ratings;
                return !is_null($ratings) && $ratings->count() > 0 ? $ratings->sum('rating') / $ratings->count() : 0;
            }
        );
    }

    public function international_id(): BelongsTo
    {
        return $this->belongsTo(InternationalId::class);
    }

    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(CustomerRating::class);
    }
}
