<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'broadcast_date' => fake()->numberBetween(1980, 2023) . '年　' .
                fake()->randomElement(['春', '夏', '秋', '冬']) . 'アニメ',
            'genre' => fake()->randomElement([10, 20]),
            'synopsis' => fake()->realText(1000),
            'key_visual_url' => 'dummy.png',
            'key_visual_reference' => fake()->sentence() . 'より引用',
        ];
    }
}
