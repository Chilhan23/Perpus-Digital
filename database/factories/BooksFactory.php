<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Books;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(rand(6, 8));
        return [
            'judul' => $title,
            'slug' => Str::slug($title),
            'penulis' => fake()->name(),
            'category_id' => Category::factory(),
            'body' => fake()->text(),
            'tahun_terbit' => fake()->year()
        ];
    }
}
