<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $attributes = [
        'banned' => 0,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function favorites()
    {
        return $this->belongsToMany(
            Books::class,
            'favorites',
            'user_id',
            'book_id'
        );
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'users_roles',
            'user_id',
            'role_id'
        );
    }

    public function isAdmin()
    {
        return $this->roles()->where('slug', 'admin')->exists();
    }

    public function isModer()
    {
        return $this->roles()->where('slug', 'moder')->exists();
    }
}
