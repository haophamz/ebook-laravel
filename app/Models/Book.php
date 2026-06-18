<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'cover',
        'epub_file',
        'description',
        'views',
        'favorites',
        'featured',
        'status',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];
}