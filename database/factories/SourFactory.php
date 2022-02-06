<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company' => $this->faker->name,
            'name' => $this->faker->name,
            'percent' => $this->faker->randomFloat(0, 10),
            'comments' => $this->faker->paragraph,
            'rating' => $this->faker->randomFloat(0, 10),
            'hasLactose' => $this->faker->boolean,
        ];
    }
}
