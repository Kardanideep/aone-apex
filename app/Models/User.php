<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'sponsor_id',
        'name',
        'email',
        'mobile',
        'password',
        'status',
        'email_verified_at',
    ];

    public function sponsor()
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function sponsoredUsers()
    {
        return $this->hasMany(User::class, 'sponsor_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'sponsor_id');
    }

    public function nestedChildren()
    {
        return $this->children()->with('nestedChildren');
    }

    public function kyc()
    {
        return $this->hasOne(UserKyc::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function walletTransactions()
    {
        return $this->hasMany(UserWalletTransaction::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
