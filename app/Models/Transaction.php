<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id'; // Explicitly setting primary key
    public $incrementing = true;              // Ensuring auto-incrementing id
    protected $keyType = 'int';               // Defining key type

    protected $fillable = [
        'initiator_id',            // The person requesting the trade (A)
        'counterparty_id',         // The person fulfilling the request (X)
        'partner_initiator_id',    // Partner of A (B) - nullable
        'partner_counterparty_id', // Partner of X (Y) - nullable
        'productp_id',             // The product being exchanged
        'quantity_p',              // Quantity of product p being offered
        'producte_id',             // The requested equivalent product/service
        'quantity_e',              // Quantity of product e being requested
        'hashkey',                 // Secure 16-digit transaction key
        'transaction_fee_total',   // Total cost of the transaction
        'created_at',              // When the transaction was initiated
        'completed_at',            // When the transaction was finalized (nullable)
        'status',                  // Pending, verified, completed
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

    public function partnerInitiator()
    {
        return $this->belongsTo(User::class, 'partner_initiator_id');
    }

    public function partnerCounterparty()
    {
        return $this->belongsTo(User::class, 'partner_counterparty_id');
    }

    public function productp()
    {
        return $this->belongsTo(Product::class, 'productp_id', 'id');
    }

    public function producte()
    {
        return $this->belongsTo(Product::class, 'producte_id', 'id');
    }
}
