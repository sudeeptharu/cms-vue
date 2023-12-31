<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebSetting>
 */
class WebSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key'=>fake()->title(),
            'value'=>fake()->title,
            'image'=>fake()->image,
            'align'=>fake()->title
        ];
    }
}
