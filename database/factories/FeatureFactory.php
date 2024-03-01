<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $title = $this->faker->randomElement(['Add', 'Fix', 'Improve']).' '. implode(' ', $this->faker->words(2, 5));
        $title = $this->faker->words(2, 5);
        return [
            'title' => $title,
            'status' => $this->faker->randomElement([
                'Requested',
                'Requested',
                'Requested',
                'Requested',
                'Requested',
                'Requested',
                'Requested',
                'Requested',
                'Requested',
                'Planned',
                'Completed',
                'Completed',
            ])
        ];
    }
}
