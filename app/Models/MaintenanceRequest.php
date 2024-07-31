<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'tenant_id', 'contractor_id', 'description', 'status'];

    /**
     * return the user(tenant) for the maintenance request
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    /**
     * return the user(contractor) for the maintenance request
     */
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }


    /**
     * return the property for the maintenance request
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
