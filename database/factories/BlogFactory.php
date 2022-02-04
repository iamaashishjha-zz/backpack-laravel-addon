<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => $title,
            'description' => $this->faker->paragraph($nbSentences = 2, $variableNbSentences = true),
            'content' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
            'image' => '/images/blogs/01.jpg',
            'blog_category_id' => rand(1, 9),
            'user_id' => rand(1, 9),
        ];
    }
}
