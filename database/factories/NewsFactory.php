<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
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
        //TODO optimization
        $faker = FakerFactory::create('ru_RU');

        return [
            'title' => '"' . $faker->company() . '"' . ' сообщает: ' . Str::limit($faker->realText(100), 95) . ' (Из базы)',
            'text' => $faker->realText(rand(1000, 3000)),
            'is_private' => false,
            'category_id' => rand(1,3),
        ];

//        return [
//            'title' => fake()->name(),
//            'text' => fake()->name(),
//            'is_private' => false,
//            'category_id' => rand(1,3),
//        ];
    }
}
