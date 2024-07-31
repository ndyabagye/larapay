<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\RoleName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the roles for the user
     * A user has many roles
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleName::ADMIN);
    }

    public function isLandlord(): bool
    {
        return $this->hasRole(RoleName::LANDLORD);
    }

    public function isTenant(): bool
    {
        return $this->hasRole(RoleName::TENANT);
    }

    public function isContractor(): bool
    {
        return $this->hasRole(RoleName::CONTRACTOR);
    }

    public function isPropertyManager(): bool
    {
        return $this->hasRole(RoleName::PROPERTY_MANAGER);
    }

    public function hasRole(RoleName $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }

    public function permissions(): array
    {
        return $this->roles()->with('permissions')
            ->get()
            ->map(function ($role) {
                return $role->permissions->pluck('name');
            })
            ->flatten()->values()->unique()->toArray();
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions(), true);
    }

    /**
     * Get the properties for the user/landlord
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'landlord_id');
    }


    /**
     * Get the applications for a user/tenant
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'tenant_id');
    }

    /**
     * Get the leases for a user/tenant
     */
    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class, 'tenant_id');
    }

    /**
     * Get the maintenance requests for a user/tenant
     */
    public function tenantMaintenanceRequests(): HasMany
    {
        return $this->hasMany(MaintenanceRequest::class, 'tenant_id');
    }

    /**
     * Get the maintenance requests for a user/contractor
     */
    public function contractorMaintenanceRequests(): HasMany
    {
        return $this->hasMany(MaintenanceRequest::class, 'contractor_id');
    }
}
