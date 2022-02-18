<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'company' => $this->faker->name,
            'name' => $this->faker->name,
            'percent' => $this->faker->randomFloat(1, 0, 10),
            'comments' => $this->faker->paragraph,
            'rating' => $this->faker->randomFloat(1, 0, 10),
            'hasLactose' => $this->faker->boolean,
        ];
    }
}
