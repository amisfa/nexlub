<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRakeLog extends Model
{

    protected $table = 'user_rake_log';

    protected $fillable = [
        'user_id',
        'rake',
        'claimed_rake_back',
        'claimed_rake_affiliate',
    ];
    protected $appends = [
        'affiliate_rake',
        'user_rake_back'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAffiliateRakeAttribute()
    {
        $referrerRakePercentage = 0;
        if ($this->user->referrer()->exists()) {
            $referrerRakePercentage = $this->user->referrer->affiliate_rake_percentage;
        }
        return number_format(($referrerRakePercentage / 100) * $this->rake, 2, '.', '');
    }

    public function getUserRakeBackAttribute()
    {
        $rakeBackPercentage = 0;
        switch ($this->user->level) {
            case 1:
                $rakeBackPercentage = 5;
                break;
            case 2:
                $rakeBackPercentage = 7;
                break;
            case 3:
                $rakeBackPercentage = 10;
                break;
            case 4:
                $rakeBackPercentage = 15;
                break;
            case 5:
                $rakeBackPercentage = 20;
                break;
            case 6:
                $rakeBackPercentage = 25;
                break;
            case 7:
                $rakeBackPercentage = 30;
                break;
            case 8:
                $rakeBackPercentage = 35;
                break;
            case 9:
                $rakeBackPercentage = 40;
                break;
            case 10:
                $rakeBackPercentage = 45;
                break;
        }
        return number_format(($rakeBackPercentage / 100) * $this->rake, 2, '.', '');
    }
}
