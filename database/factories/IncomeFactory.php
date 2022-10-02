<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
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
            'amount' =>  $this->faker->numberBetween(10, 50), 
            'value' =>  $this->faker->randomFloat(1, 50, 600),
            'total_value' => $this->faker->randomFloat(1, 50, 600),
            'category' => $this->faker->randomElement(['ROPA', 'ACCESORIOS']),
            'owner' => $this->faker->randomElement(['JOSIEL', 'ROSA']),
            'discount' =>  $this->faker->randomFloat(1, 50, 600),
            'client' => $this->faker->name(), 
            'created_at' => $this->faker->dateTimeThisYear('+ 20 days')->format('Y-m-d')
        ];
    }
}
