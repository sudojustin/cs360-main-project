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
        'id',   // Unique product identifier
        'owner_id',     // ID of the user who owns the product
        'name',         // Name of the product
        'value',        // Value of the product
        'quantity',     // Quantity available for barter 
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'productp_id')->orWhere('producte_id', $this->id);
    }

    // Relationship with User - a product belongs to a user
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
