<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'is_favorite',
        'progress',
        'last_read_at',
         'reading_position',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'last_read_at' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}