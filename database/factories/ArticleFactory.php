<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'text' => $this->faker->paragraph(3, true),
            'image_path' => 'article_images/img.png',
            'author_id' => random_int(1, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
