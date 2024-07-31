<?php

namespace Database\Factories;

use App\Enum\PaymentStatus;
use App\Enum\PaymentType;
use App\Models\Lease;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Payment::class;

    public function definition(): array
    {
        /**
         * Create a new lease
         */
        $newLease = Lease::factory()->create();

        /**
         * Fetch or create a lease
         */
        $lease = Lease::inRandomOrder()->first() ?? $newLease;

        return [
            'lease_id' => $lease->id,
            'amount' => $lease->property->price,
            'payment_status' => $this->faker->randomElement(PaymentStatus::class),
            'payment_type' => $this->faker->randomElement(PaymentType::class),
        ];
    }
}
