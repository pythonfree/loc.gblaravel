<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => '"' . fake('ru_RU')->company() . '"' . ' сообщает: ' . Str::limit(fake('ru_RU')->realText(100), 95) . ' (Из базы)',
            'text' => fake('ru_RU')->realText(rand(1000, 3000)),
            'is_private' => false,
            'category_id' => rand(1, 3),
        ];
    }
}
