<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Malico\LaravelNanoid\HasNanoids;

class UserInvoice extends Model
{
    use SoftDeletes, HasNanoids;

    protected $table = 'user_invoice';
    protected array $nanoidLength = [10, 20];
    protected string $nanoidPrefix = 'cl_';

    protected $fillable = [
        'invoice_id',
        'user_id',
        'plisio_id',
        'invoice_token',
        'invoice_url',
        'price_amount',
        'paid_at',
        'failed_at',
        'dropped_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
