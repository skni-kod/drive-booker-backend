<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'card_first_name' => fake()->card_first_name,
            'card_last_name' => fake()->card_last_name,
            'card_number' => fake()->card_number,
            'card_expiry_date' => fake()->card_expiry_date,
            'card_cvv' => fake()->card_cvv,
        ];
    }
}
