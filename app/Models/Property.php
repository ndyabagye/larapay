<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'price', 'description', 'availability', 'landlord_id'];

    /**
     * Get the user that owns the property.
     */
    public function landlord(): BelongsTo
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

//
//    public function property_manager(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }


    /**
     * Get the applications for the property
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the leases for the property
     */
    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    /**
     * Get the active lease for the property
     */
    public function activeLease(): HasOne
    {
        return $this->hasOne(Lease::class)->where('end_date', '>', now());
    }

    /**
     * Get the maintenance requests for the property
     */
    public function maintenaceRequests(): HasMany{
        return $this->hasMany(MaintenanceRequest::class);
    }

}
