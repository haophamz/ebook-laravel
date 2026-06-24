<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [

        'order_id',

        'gateway',

        'transaction_code',

        'gateway_order_id',

        'amount',

        'status',

        'response',

        'paid_at'
    ];

    protected $casts = [

        'response' => 'array',

        'paid_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}