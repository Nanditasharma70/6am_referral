<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     protected $fillable = [
//         'username', 'email', 'password', 'referral_code', 'referred_by',
//     ];

//     public function referredBy()
//     {
//         return $this->belongsTo(User::class, 'referred_by');
//     }

//     public function referrals()
//     {
//         return $this->hasMany(User::class, 'referred_by');
//     }
// }


// class User extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     protected $fillable = [
//         'username',
//         'email',
//         'password',
//         'referral_code',
//         'referral_points',
//     ];

//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];
// }
class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'referral_code',
        'referral_points',
        'referred_by',
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }
}