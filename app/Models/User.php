<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'password',

        'email_verified_at',

        'is_admin',
        'is_active',

        'membership_type',
        'vip_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'vip_expires_at' => 'datetime',

            'password' => 'hashed',

            'is_admin' => 'boolean',

            'is_active' => 'boolean',

        ];
    }

    /**
     * Kiểm tra còn VIP hay không
     */
    public function isVip(): bool
    {
        return $this->membership_type === 'vip'
            && $this->vip_expires_at !== null
            && $this->vip_expires_at->isFuture();
    }

    /**
     * Kiểm tra Admin
     */
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    /**
     * Reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * User Books
     */
    public function userBooks()
    {
        return $this->hasMany(UserBook::class);
    }

    /**
     * Favorite Books
     */
    public function favoriteBooks()
    {
        return $this->belongsToMany(
            Book::class,
            'user_books'
        )->wherePivot('is_favorite', true);
    }
    public function bookPurchases()
{
    return $this->hasMany(BookPurchase::class);
}
public function purchasedBooks()
{
    return $this->belongsToMany(\App\Models\Book::class, 'orders', 'user_id', 'book_id')
                ->where('orders.status', 'paid') // Chỉ lấy sách đã thanh toán
                ->withTimestamps();
}
}