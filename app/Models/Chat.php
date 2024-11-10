<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $fillable = [
        'title',
        'user_id'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function chats(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
