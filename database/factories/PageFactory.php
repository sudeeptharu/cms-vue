<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>fake()->title,
            'subtitle' => fake()->title(),
            'description' => fake()->title,
            'quote' => fake()->sentence(),
            'excerpt' => fake()->title,
            'draft' => fake()->boolean,
            'slug' => fake()->title,
            'image' => fake()->image
        ];
    }
}
