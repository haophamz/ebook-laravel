<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'is_admin',
        'message',
        'image',
        'seen_at',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'seen_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}