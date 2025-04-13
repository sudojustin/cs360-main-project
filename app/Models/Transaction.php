<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id'; // Explicitly setting primary key
    public $incrementing = true;              // Auto-incrementing id
    protected $keyType = 'int';               // Integer key type

    protected $fillable = [
        'transaction_id',
        'initiator_id',            // A: The person requesting the trade 
        'counterparty_id',         // X: The person who has product P
        'partner_b_id',            // B: Partner of A who has product E
        'partner_y_id',            // Y: Partner of X who receives product E
        'productp_id',             // The product P being exchanged from X to A
        'quantity_p',              // Quantity of product P being transferred
        'producte_id',             // The product E being exchanged from B to Y
        'quantity_e',              // Quantity of product E being transferred
        'hashkey',                 // Secure 16-digit transaction key
        'hash_key',                // Complete 16-digit secure hash key
        'hash_first',              // First half of hash (given to A)
        'hash_second',             // Second half of hash (given to Y)
        'transaction_fee_total',   // Total cost of the transaction
        'fee_amount',              // Total cost of the transaction
        'created_at',              // When the transaction was initiated
        'completed_at',            // When the transaction was finalized (nullable)
        'status',                  // Pending, PartnerSelected, Verified, Completed, Rejected
        'last_action_by',          // The user who performed the last action
        'initiator_confirmed',     // Whether the initiator has confirmed the trade with their hash
        'counterparty_confirmed',  // Whether the counterparty has confirmed the trade with their hash
    ];

    public $timestamps = false; // Using custom timestamps

    // Relationships
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    public function counterparty()
    {
        return $this->belongsTo(User::class, 'counterparty_id', 'id');
    }

    public function partnerB()
    {
        return $this->belongsTo(User::class, 'partner_b_id');
    }

    public function partnerY()
    {
        return $this->belongsTo(User::class, 'partner_y_id');
    }

    public function lastActionUser()
    {
        return $this->belongsTo(User::class, 'last_action_by');
    }

    public function productp()
    {
        return $this->belongsTo(Product::class, 'productp_id', 'id');
    }

    public function producte()
    {
        return $this->belongsTo(Product::class, 'producte_id', 'id');
    }
    
    // Alias relationships for compatibility with existing views
    public function partnerInitiator()
    {
        return $this->belongsTo(User::class, 'partner_b_id');
    }

    public function partnerCounterparty()
    {
        return $this->belongsTo(User::class, 'partner_y_id');
    }
}
