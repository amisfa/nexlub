<?php

namespace App\Models;

use App\Mail\VerifyEmail;
use App\Traits\hasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use hasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
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

    protected $appends = ['referral_link'];

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

    protected static function boot()
    {
        parent::boot();

        static::updating(function (User $user) {
            if (in_array('email', $user->getChanges())) {
                $user->email_verified_at = null;
                $token = Str::random(64);
                UserVerify::create(['user_id' => $user->id, 'token' => $token]);
                Mail::to($user->email)->send(new VerifyEmail($token, $user));
            }
        });
    }

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

    public function withdraw(): HasMany
    {
        return $this->hasMany(UserWithdraw::class, 'user_id');
    }
}
