<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "color" => $this->faker->randomElement(['Red', 'White', 'Black', 'Gray', 'Green', 'Blue' , 'Yellow']),
            "number" => $this->faker->numberBetween(1, 1000),
        ];
    }
}