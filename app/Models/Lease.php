<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lease extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'property_id', 'start_date', 'end_date', 'security_deposit'];

    /**
     * Get the property for a lease
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the user for a lease
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    /**
     * Get the payments for a lease
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
