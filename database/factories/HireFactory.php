<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence(4), 
            'client' => $this->faker->name(), 
            'total_value' => $this->faker->randomFloat(1, 50, 600),
            'created_at' => $this->faker->dateTimeThisYear(now())->format('Y-m-d')
        ];
    }
}
