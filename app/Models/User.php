<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
            'is_active' => 'boolean',
        ];
    }

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class, 'user_id');
    }

    public function lenderWallet(): HasOne
    {
        return $this->hasOne(LenderWallet::class, 'lender_id');
    }

    public function topups(): HasMany
    {
        return $this->hasMany(Topup::class, 'lender_id');
    }

    public function adminTopups(): HasMany
    {
        return $this->hasMany(Topup::class, 'admin_id');
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class, 'lender_id');
    }
}
