<?php

namespace Database\Seeders;

use App\Enum\RoleName;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->createLandlordUser();
        $this->createTenantUser();
        $this->createContractorUser();
        $this->createPropertyManagerUser();
    }

    public function createAdminUser(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->roles()->sync(Role::where('name', RoleName::ADMIN)->first());
    }

    public function createTenantUser(): void
    {
        User::create([
            'name' => 'Tenant User',
            'email' => 'tenant@tenant.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->roles()->sync(Role::where('name', RoleName::TENANT)->first());
    }

    public function createLandlordUser(): void
    {
        User::create([
            'name' => 'Landlord User',
            'email' => 'landlord@landlord.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->roles()->sync(Role::where('name', RoleName::LANDLORD)->first());
    }

    public function createPropertyManagerUser(): void
    {
        User::create([
            'name' => 'Property User',
            'email' => 'pm@pm.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->roles()->sync(Role::where('name', RoleName::PROPERTY_MANAGER)->first());
    }

    public function createContractorUser(): void
    {
        User::create([
            'name' => 'Contractor User',
            'email' => 'contractor@contractor.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->roles()->sync(Role::where('name', RoleName::CONTRACTOR)->first());
    }
}
