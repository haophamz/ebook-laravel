<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [

        'code',
        'name',

        'discount_percent',
        'discount_amount',

        'min_order_amount',

        'usage_limit',
        'used_count',

        'expired_at',

        'active'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'active' => 'boolean',
    ];
}