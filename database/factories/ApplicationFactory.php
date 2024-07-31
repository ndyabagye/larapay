<?php

namespace Database\Factories;

use App\Enum\ApplicationStatus;
use App\Enum\RoleName;
use App\Models\Application;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Application::class;

    public function definition(): array
    {
        /**
         * Create a new tenant
         */
        $newTenant = User::factory()->create();
        $newTenant->roles()->sync(Role::where('name', RoleName::TENANT->value)->first());

        /**
         * Fetch or create a tenant user
         */

        $user = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', RoleName::TENANT->value)
            ->inRandomOrder()
            ->select('users.*')
            ->first()
            ?? $newTenant;

        /**
         * Fetch or create a property
         */
        $property = Property::inRandomOrder()->first() ?? Property::factory()->create();

        return [
            'tenant_id' => $user->id,
            'property_id' => $property->id,
            'status' => $this->faker->randomElement(ApplicationStatus::class),
            'document' => $this->faker->paragraph()
        ];
    }
}
