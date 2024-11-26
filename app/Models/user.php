<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'username',
        'name',
        'nama_lengkap',
        'alamat',
        'hp',
        'email',
        'password',
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
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Define a one-to-one relationship with the Role model.
     *
     * @return HasOne
     */
    public function hasRole(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    /**
     * Check if the user has an admin role.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole()->where('role', 'admin')->exists();
    }

    /**
     * Check if the user has a user role.
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->hasRole()->where('role', 'user')->exists();
    }
}
