<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'message',
        'ChatID'
    ];
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
