<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'adress' => $this->faker->address,
            'user_id' => $this->faker->numberBetween(1,25),
        ];
    }
}
