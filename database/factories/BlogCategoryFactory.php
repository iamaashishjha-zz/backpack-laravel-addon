<?php

namespace Database\Factories;

use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // $faker = Faker\Factory::create();

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
