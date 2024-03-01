<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = substr($this->faker->sentence(), 0, 1);
        $title = $this->faker->sentence();
        return [
            'author_id' => rand(1,20),
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraph(500, true),
            'published_at' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
