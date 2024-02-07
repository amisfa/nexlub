<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'user_ticket';

    protected $fillable = [
        'user_id',
        'subject',
        'closed_at'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(TicketComments::class, 'ticket_id');
    }
}
