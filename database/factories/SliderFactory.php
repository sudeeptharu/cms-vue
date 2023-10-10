<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order'=>fake()->numberBetween(0,5),
            'image'=>fake()->image,
            'url'=>fake()->url,
            'is_published'=>fake()->boolean,
            'title'=>fake()->title,
            'description'=>fake()->title,
        ];
    }
}
