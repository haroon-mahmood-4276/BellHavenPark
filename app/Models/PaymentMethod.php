<?php

namespace App\Models;

use App\Utils\Enums\CustomerAccounts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'slug',
        'linked_account',
    ];

    protected $hidden = [];

    protected $casts = [
        'linked_account' => CustomerAccounts::class,
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public $rules = [
        'name' => 'required|string|min:1|max:30',
        'slug' => 'required|string|min:1|max:30|unique:payment_methods,slug',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->rules['linked_account'] = 'nullable|in:' . implode(',', CustomerAccounts::values());
    }
}
