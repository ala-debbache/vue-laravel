<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(1, 25),
            'provider_id' => $this->faker->numberBetween(1, 25),
            'total' => $this->faker->randomFloat(),
        ];
    }
}
