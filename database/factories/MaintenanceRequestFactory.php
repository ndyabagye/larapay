<?php

namespace Database\Factories;

use App\Enum\MaintenanceRequestStatus;
use App\Enum\RoleName;
use App\Models\MaintenanceRequest;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceRequest>
 */
class MaintenanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MaintenanceRequest::class;

    public function definition(): array
    {
        /**
         * Create a new tenant
         */
        $newMaintenanceTenant = User::factory()->create();
        $newMaintenanceTenant->roles()->sync(Role::where('name', RoleName::TENANT->value)->first());

        /**
         * Fetch or create a tenant user
         */
        $user = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', RoleName::TENANT->value)
            ->inRandomOrder()
            ->select('users.*')
            ->first()
            ?? $newMaintenanceTenant;


        /**
         * Create a new contractor
         */
        $newContractor = User::factory()->create();
        $newContractor->roles()->sync(Role::where('name', RoleName::CONTRACTOR->value)->first());

        /**
         * Fetch or create a contractor user
         */
        $user = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', RoleName::CONTRACTOR->value)
            ->inRandomOrder()
            ->select('users.*')
            ->first()
            ?? $newContractor;


        /**
         * Fetch or create a property
         */
        $property = Property::inRandomOrder()->first() ?? Property::factory()->create();

        return [
            'tenant_id' => $newMaintenanceTenant->id,
            'contractor_id' => $newContractor->id,
            'property_id' => $property->id,
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(MaintenanceRequestStatus::class)
        ];
    }
}
