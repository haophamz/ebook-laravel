<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'title',
        'category',
        'description',
        'image_path',
        'status',
        'admin_note',
    ];

    // Nhãn tiếng Việt cho danh mục, dùng để hiển thị ở blade/admin
    public const CATEGORIES = [
        'payment' => 'Thanh toán & Đơn hàng',
        'vip'     => 'Hội viên VIP',
        'ebook'   => 'Lỗi đọc Ebook',
        'account' => 'Tài khoản',
        'other'   => 'Khác',
    ];

    public const STATUSES = [
        'pending'    => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'resolved'   => 'Đã xử lý',
        'closed'     => 'Đã đóng',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
   public function replies()
{
    return $this->hasMany(
        SupportReply::class,
        'ticket_id'
    );
}
}