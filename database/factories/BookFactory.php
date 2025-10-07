<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'titulo' => $this->faker->sentence(3),
            'author_id' => Author::inRandomOrder()->first()?->id ?? Author::factory(),
            'editorial' => $this->faker->company(),
            'publicacion' => $this->faker->year(),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
