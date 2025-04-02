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
        'name',
        'email',
        'password',
        'is_admin',
        'partner_id',
    ];

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
            'is_admin' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->is_admin ?? false;
    }

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    /**
     * Get products directly owned by the user (legacy relationship).
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'owner_id');
    }

    /**
     * Get products owned by the user with quantities through the UserProduct model.
     */
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }

    /**
     * Get all products through the UserProduct relationship.
     */
    public function inventory()
    {
        return $this->belongsToMany(Product::class, 'user_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function transactionsAsInitiator()
    {
        return $this->hasMany(Transaction::class, 'initiator_id');
    }

    public function transactionsAsPartner()
    {
        return $this->hasMany(Transaction::class, 'partner_id');
    }
}
