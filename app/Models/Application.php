<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'document', 'tenant_id', 'property_id'];

    /**
     * Get the user for the application
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    /**
     * Get the property for the application
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
