<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

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
        'tenants',
    ];

    protected $casts = [
        // 'dob' => 'datetime',
        'tenants' => 'array',
    ];

    protected $hidden = [];

    protected $appends = ['name'];

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
        'tenants' => 'nullable|array',
        'tenants.*.tenant_first_name' => 'sometimes|string|min:3|max:50',
        'tenants.*.tenant_last_name' => 'sometimes|string|min:3|max:50',
        'tenants.*.tenant_phone' => 'sometimes|numeric|min_digits:3|max_digits:20',
        'tenants.*.tenant_dob' => 'sometimes|date',
    ];

    public $rulesMessages = [
        'tenants.*.tenant_first_name.string' => 'The :attribute must be a string.',
        'tenants.*.tenant_first_name.min' => 'The :attribute must be at least :min characters.',
        'tenants.*.tenant_first_name.max' => 'The :attribute must not be greater than :max characters.',

        'tenants.*.tenant_last_name.string' => 'The :attribute must be a string.',
        'tenants.*.tenant_last_name.min' => 'The :attribute must be at least :min characters.',
        'tenants.*.tenant_last_name.max' => 'The :attribute must not be greater than :max characters.',

        'tenants.*.tenant_phone.numeric' => 'The :attribute must be a number.',
        'tenants.*.tenant_phone.min_digits' => 'The :attribute must have at least :min digits.',
        'tenants.*.tenant_phone.max_digits' => 'The :attribute must not have more than :max digits.',

        'tenants.*.tenant_dob.date' => 'The :attribute is not a valid date.',
    ];

    public $rulesAttributes = [
        'tenants.*.tenant_name' => 'Tenant name',
        'tenants.*.tenant_phone' => 'Tenant phone',
        'tenants.*.tenant_dob' => 'Tenant dob',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName(self::class)->logFillable();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ucfirst($attributes['first_name']) . ' ' . ucfirst($attributes['last_name']),
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

    public function international_id(): BelongsTo
    {
        return $this->belongsTo(InternationalId::class);
    }
}
