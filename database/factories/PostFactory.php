<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 5)),
            'excerpt' => $this->faker->paragraph(1),
            'content' => collect($this->faker->paragraphs(mt_rand(3, 8)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'slug' => $this->faker->slug(),
            'user_id' => mt_rand(1, count(User::all())),
            'category_id' => mt_rand(1, count(Category::all()))
        ];
    }
}
