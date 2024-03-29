<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Login;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $fillable = [
       'name',
       'email',
       'username',
       'password',
   ];

//    protected $guarded = [];

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
        'email_verified_at' => 'datetime',
    ];

//    public function school()
//    {
//        return $this->hasOne(School::class);
//    }
//
//    public function company()
//    {
//        return $this->hasOne(Company::class);
//    }

    public function post()
    {
        return $this->hasMany(Post::class, 'auhtor_id');
    }

    public function logins()
    {
        return $this->hasMany(\App\Models\Login::class);
    }

//    public function scopeWithLastLoginAt($query)
//    {
//        $query->addSelect(['last_login_at' => \App\Models\Login::query()
//            ->select('created_at')
//            ->whereColumn('user_id', 'users.id')
//            ->latest()
//            ->take(1)
//        ])
//            ->withCasts(['last_login_at' => 'datetime']);
//    }
//
//    public function scopeWithLastLoginIpAddress($query)
//    {
//        $query->addSelect(['last_login_ip_address' => \App\Models\Login::query()
//            ->select('ip_address')
//            ->whereColumn('user_id', 'users.id')
//            ->latest()
//            ->take(1)
//        ]);
//    }


//    public function lastLogin()
//    {
//        return $this->belongsTo(Login::class);
//    }

    public function scopeWithLastLogin($query)
    {
        $query->addSelect(['last_login_id' => Login::query()
            ->select('id')
            ->whereColumn('user_id', 'users.id')
            ->latest()
            ->take(1)
        ])->with('lastLogin');
    }

    public function lastLogin()
    {
//        return $this->hasOne(Login::class)->latest();
        return $this->hasOne(Login::class)->latest()->take(1);
    }


}

