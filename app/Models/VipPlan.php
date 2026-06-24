<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipPlan extends Model
{
    protected $fillable = [
        'name',
        'months',
        'price',
        'description',
        'sort',
        'active',
        'is_popular',
    ];

    protected $casts = [
        'price'      => 'decimal:0',
        'months'     => 'integer',
        'sort'       => 'integer',
        'active'     => 'boolean',
        'is_popular' => 'boolean',
    ];

    /**
     * Giá quy đổi theo tháng (vd: gói 3 tháng 297.000đ -> 99.000đ/tháng)
     */
    public function getPricePerMonthAttribute(): float
    {
        return $this->months > 0
            ? (float) $this->price / $this->months
            : (float) $this->price;
    }
}