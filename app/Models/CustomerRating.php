<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerRating extends Model
{
    use SoftDeletes, HasFactory;

    protected $dateFormat = 'U';

    protected $fillable = [
        'customer_id',
        'rating',
        'comments',
    ];

    protected $casts = [
        'rating' => 'float',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    protected $hidden = [];

    public $rules = [
        'customer_id' => 'required|numeric|exists:customers,id',
        'rating' => 'required|decimal|gte:0',
        'comments' => 'sometimes|string|size:254',
    ];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
