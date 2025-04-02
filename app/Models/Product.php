<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Explicitly setting primary key
    public $incrementing = true;          // Ensuring auto-incrementing ID
    protected $keyType = 'int';

    protected $fillable = [
        'id',           // Unique product identifier
        'owner_id',     // ID of the user who owns the product (can be null now)
        'name',         // Name of the product
        'value',        // Value of the product
        'quantity',     // Quantity available for barter (legacy field)
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'productp_id')->orWhere('producte_id', $this->id);
    }

    /**
     * Get the owner of the product (legacy relationship).
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get all entries in user_products for this product.
     */
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }

    /**
     * Get all users who have this product through the UserProduct relationship.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
