<?php

namespace Database\Factories;

use App\Enum\RoleName;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Property::class;

    public function definition(): array
    {
        /**
         * Create a new landlord
         */
        $newLandlord = User::factory()->create();
        $newLandlord->roles()->sync(Role::where('name', RoleName::LANDLORD->value)->first());

        /**
         * Fetch or create a landlord user
         */
        $user = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.name', RoleName::LANDLORD->value)
            ->inRandomOrder()
            ->select('users.*')
            ->first()
            ?? $newLandlord;

        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'price' => $this->faker->numberBetween(100000, 1000000),
            'description' => $this->faker->paragraph,
            'availability' => $this->faker->boolean,
            'landlord_id' => $user->id,
        ];
    }
}
