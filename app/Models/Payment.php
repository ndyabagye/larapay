<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['lease_id', 'amount', 'payment_date', 'payment_status'];

    /**
     * Get the lease for a payment
     */
    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }
}
