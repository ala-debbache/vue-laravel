<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nif' => $this->faker->randomNumber(5, true),
            'nis' => $this->faker->randomNumber(5, true),
            'user_id' => $this->faker->numberBetween(26,50),
        ];
    }
}
