<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\UserBook;
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
        'is_vip',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_top' => 'boolean',
        'is_vip' => 'boolean',
        'views' => 'integer',
        'favorites' => 'integer',
    ];

    /**
     * Danh mục của sách
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}