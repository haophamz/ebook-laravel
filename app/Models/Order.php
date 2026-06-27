<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'user_id',
        'vip_plan_id',
        'coupon_id',

        'order_code',

        'amount',
        'discount',
        'final_amount',

        'payment_method',
        'status',

        'paid_at'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function vipPlan()
{
    return $this->belongsTo(VipPlan::class);
}

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function plan()
{
    return $this->belongsTo(VipPlan::class, 'vip_plan_id');
}
}