<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'SKU' => $this->faker->bothify('???????##########'),
            'description' => $this->faker->sentence(4),
            'cost' =>  $this->faker->randomFloat(1, 50, 600),
            'price' => $this->faker->randomFloat(1, 50, 600),
        ];
    }
}
