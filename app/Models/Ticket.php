<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    public $table = "user_ticket";

    protected $fillable = [
        'user_id',
        'thread_id',
        'subject',
        'reply_to_id',
        'comment',
        'category',
        'closed_at'
    ];
    protected $appends = [
        'answered_by_admin',
        'replied_by_admin'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function threads(): HasMany
    {
        return $this->hasMany(Ticket::class, 'thread_id');
    }

    public function replied(): HasOne
    {
        return $this->hasOne(Ticket::class, 'replied_to_id');
    }

    public function replyTo(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'replied_to_id');
    }

    public function getRepliedByAdminAttribute()
    {
        return $this->replied()->exists();
    }

    public function GetAnsweredByAdminAttribute()
    {
        $hasThread = $this->threads()->exists();
        if (!$hasThread) return false;
        if ($hasThread) return $this->threads()->latest()->first()->replied_by_admin;
    }
}
