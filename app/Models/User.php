<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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
        'password',
        'username',
        'phone_no',
        'wallet_no',
        'referrer_id',
        'referral_token',
        'email_verified_at',
        'avatar',
        'balance',
        'banned_id',
        'level'
    ];
    protected $table = 'auth_user';

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

    protected $appends = [
        'referral_link',
        'remain_rake_back',
        'claimed_rake_back',
        'total_rake_back',
        'remain_affiliate_rake',
        'claimed_affiliate_rake',
        'total_affiliate_rake',
        'unclaimed_bad_beat',
        'unclaimed_jack_pot'
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

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
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

    public function ringGameStats(): HasMany
    {
        return $this->hasMany(UserRingGameStat::class, 'user_id');
    }

    public function sngStats(): HasMany
    {
        return $this->hasMany(UserSNGStat::class, 'user_id');
    }

    public function badBeatRewards(): HasMany
    {
        return $this->hasMany(UserBadBeatReward::class);
    }

    public function jackPotRewards(): HasMany
    {
        return $this->hasMany(UserJackPotReward::class);
    }

    public function getRemainRakeBackAttribute()
    {
        $remainRake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $remainRake = floatval($query->user_rake_back) - floatval($query->claimed_rake_back);
        }
        return floatval($remainRake);
    }

    public function getClaimedRakeBackAttribute()
    {
        $claimedRake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $claimedRake = floatval($query->claimed_rake_back);
        }
        return $claimedRake;
    }

    public function getTotalRakeBackAttribute()
    {
        $rake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $rake = floatval($query->user_rake_back);
        }
        return $rake;
    }

    public function getRemainAffiliateRakeAttribute()
    {
        $remainRake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $remainRake += floatval($query->affiliate_rake) - floatval($query->claimed_rake_affiliate);
        }
        return $remainRake;
    }

    public function getClaimedAffiliateRakeAttribute()
    {
        $claimedRake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $claimedRake = floatval($query->claimed_rake_affiliate);
        }
        return $claimedRake;
    }

    public function getTotalAffiliateRakeAttribute()
    {
        $rake = 0;
        if ($this->userRake()->exists()) {
            $query = $this->userRake()->first();
            $rake = floatval($query->affiliate_rake);
        }
        return $rake;
    }

    public function getUnclaimedJackPotAttribute()
    {
        return $this->jackPotRewards()->whereNull('claimed_at')->count();
    }

    public function getUnclaimedBadBeatAttribute()
    {
        return $this->badBeatRewards()->whereNull('claimed_at')->count();
    }
}
