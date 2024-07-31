<?php

namespace Database\Factories;

use App\Enum\ApplicationStatus;
use App\Enum\RoleName;
use App\Models\Lease;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lease>
 */
class LeaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Lease::class;

    public function definition(): array
    {
        {
            /**
             * Create a new tenant
             */
            $newAcceptedTenant = User::factory()->create();
            $newAcceptedTenant->roles()->sync(Role::where('name', RoleName::TENANT->value)->first());

            /**
             * Fetch or create a tenant user
             */
            $user = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.name', RoleName::TENANT->value)
                ->inRandomOrder()
                ->select('users.*')
                ->first()
                ?? $newAcceptedTenant;

            /**
             * Fetch or create a property
             */
            $property = Property::inRandomOrder()->first() ?? Property::factory()->create();

            /**
             * Create a start and end date
             */
            $startDate = Carbon::createFromTimestamp($this->faker->dateTimeBetween('-30days', '+30days')->getTimestamp());
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addMonth();

            return [
                'tenant_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'security_deposit' => $this->faker->numberBetween(100000, 1000000),
            ];
        }
    }
}
