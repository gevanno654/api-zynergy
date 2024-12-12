<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'verification_codes',
        'verification_codes_created_at',
        'email_verified_at',
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
        'email_verified_at' => 'datetime',
        'verification_codes_created_at' => 'datetime',
    ];

        public function activities()
    {
        return $this->hasOne(UserActivity::class);
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interest');
    }

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class, 'user_favorites');
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'user_disease');
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'user_allergy');
    }

}
