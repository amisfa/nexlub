<?php

namespace App\Models;

use App\Traits\hasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use hasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'affiliate_rake_percentage',
        'rake_back_percentage',
        'password',
        'username',
        'phone_no',
        'wallet_no',
        'referrer_id',
        'referral_token',
        'email_verified_at',
        'avatar',
        'balance',
    ];
    protected $table = 'auth_user';

    protected $appends = [
        'referral_link',
        'remainRake',
        'claimedRake'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    public function getReferralLinkAttribute(): string
    {
        return $this->referral_link = route('signup', ['ref' => $this->referral_token]);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(UserInvoice::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function withdraws(): HasMany
    {
        return $this->hasMany(UserWithdraw::class, 'user_id');
    }

    public function userRake(): HasOne
    {
        return $this->hasOne(UserRakeLog::class, 'user_id');
    }

    public function getRemainRakeBackAttribute(): int
    {
        $remainRake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $remainRake = number_format($query->userRakeBack) - number_format($query->claimed_rake_back);
        }
        return $remainRake;
    }

    public function getClaimedRakeBackAttribute(): float|int
    {
        $claimedRake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $claimedRake = number_format($query->claimed_rake_back);
        }
        return $claimedRake;
    }

    public function getTotalRakeBackAttribute(): float|int
    {
        $rake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $rake = number_format($query->userRakeBack);
        }
        return $rake;
    }
}
