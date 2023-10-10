<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MneuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->title,
            'order'=>fake()->numberBetween(0,3),
            'url'=>fake()->url,
            'is_published'=>fake()->boolean,
            'opens_in_new_tab'=>fake()->boolean,
            'parent_id'=>fake()->numberBetween(1,45)
        ];
    }
}
