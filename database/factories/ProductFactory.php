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
            'name' => $this->faker->name(),
            'productID' => $this->faker->unique()->bothify($string = '##_??'),
            'stocks' => $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat('2',0,100),
            'tax' => $this->faker->randomFloat('2',0,8),
        ];
    }
}
