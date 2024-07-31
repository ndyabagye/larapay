<?php

namespace Database\Seeders;

use App\Enum\RoleName;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();
        $this->createLandlordRole();
        $this->createTenantRole();
        $this->createContractorRole();
        $this->createPropertyManagerRole();
    }

    protected function createRole(RoleName $role, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'user.%')
            ->orWhere('name', 'like', 'admin.%')
            ->orWhere('name', 'like', 'tenant.%')
            ->orWhere('name', 'like', 'contractor.%')
            ->orWhere('name', 'like', 'property_manager.%')
            ->orWhere('name', 'like', 'landlord.%')
            ->orWhere('name', 'like', 'property.%')
            ->orWhere('name', 'like', 'application.%')
            ->orWhere('name', 'like', 'lease.%')
            ->orWhere('name', 'like', 'maintenance_request.%')
            ->orWhere('name', 'like', 'payment.%')
            ->pluck('id');

        $this->createRole(RoleName::ADMIN, $permissions);
    }

    protected function createTenantRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'tenant.%')
            ->where('name', 'like', 'property.%')
            ->where('name', 'like', 'application.%')
            ->where('name', 'like', 'lease.%')
            ->where('name', 'like', 'maintenance_request.%')
            ->where('name', 'like', 'payment.%')
            ->pluck('id');

        $this->createRole(RoleName::TENANT, $permissions);
    }

    protected function createContractorRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'contractor.%')
            ->where('name', 'like', 'property.%')
            ->where('name', 'like', 'maintenance_request.%')
            ->pluck('id');

        $this->createRole(RoleName::CONTRACTOR, $permissions);
    }

    protected function createPropertyManagerRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'property_manager.%')
            ->where('name', 'like', 'tenant.%')
            ->where('name', 'like', 'landlord.%')
            ->where('name', 'like', 'application.%')
            ->where('name', 'like', 'lease.%')
            ->where('name', 'like', 'maintenance_request.%')
            ->where('name', 'like', 'payment.%')
            ->pluck('id');

        $this->createRole(RoleName::CONTRACTOR, $permissions);
    }

    protected function createLandlordRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'landlord.%')
            ->where('name', 'like', 'tenant.%')
            ->where('name', 'like', 'property_manager.%')
            ->where('name', 'like', 'application.%')
            ->where('name', 'like', 'lease.%')
            ->where('name', 'like', 'maintenance_request.%')
            ->where('name', 'like', 'payment.%')
            ->pluck('id');

        $this->createRole(RoleName::LANDLORD, $permissions);
    }


}
