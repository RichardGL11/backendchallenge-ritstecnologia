<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'status' => OrderStatus::class
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
