<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equivalence extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'productp_id',       // Product P ID
        'producte_id',       // Product E ID
        'weight_percentage', // w% - equivalence factor (0.8 = 80%)
        'transfer_cost_p',   // c'% - cost percentage for transferring P to A (0.05 = 5%)
        'transfer_cost_e',   // c"% - cost percentage for transferring E to Y (0.03 = 3%)
    ];

    /**
     * Get the product P in this equivalence relationship.
     */
    public function productP()
    {
        return $this->belongsTo(Product::class, 'productp_id');
    }

    /**
     * Get the product E in this equivalence relationship.
     */
    public function productE()
    {
        return $this->belongsTo(Product::class, 'producte_id');
    }

    /**
     * Calculate how much of product E is needed for a given quantity of product P
     * considering the weight percentage and transfer costs.
     * 
     * @param int $quantityP The quantity of product P
     * @return float The required quantity of product E
     */
    public function calculateEquivalentAmount($quantityP)
    {
        // Get the products
        $productP = $this->productP;
        $productE = $this->productE;
        
        // Calculate total value of P after transfer cost
        $valueP = $quantityP * $productP->value * (1 - $this->transfer_cost_p);
        
        // Calculate value of 1 unit of E with equivalence factor and transfer cost
        $valueE = $productE->value * $this->weight_percentage * (1 - $this->transfer_cost_e);
        
        // Calculate required quantity of E
        $requiredE = $valueP / $valueE;
        
        return $requiredE;
    }
}
