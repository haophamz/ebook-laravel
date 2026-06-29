<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\UserBook;
use App\Models\Review;
use App\Models\Comment;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'category_id',
        'cover',
        'epub_file',
        'description',
        'views',
        'favorites',
        'featured',
        'is_top',
        'access_type',
        'price',
        'status',
    ];

    protected $casts = [
        'featured'    => 'boolean',
        'is_top'      => 'boolean',
        'views'       => 'integer',
        'favorites'   => 'integer',
        'price'       => 'decimal:0',
    ];

    /**
     * Danh mục
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Đánh giá
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Bình luận
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function purchases()
{
    return $this->hasMany(BookPurchase::class);
}
}