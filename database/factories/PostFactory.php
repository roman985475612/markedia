<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->word,
            'description' => $this->faker->sentence(),
            'content'     => $this->faker->paragraph(),
            'views'       => $this->faker->numberBetween(0, 5000),
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id'     => $this->faker->numberBetween(1, 5),
            'thumbnail'   => 'https://source.unsplash.com/collection/' . $this->faker->numberBetween(0, 100) . '/1600x900',
        ];
    }
}
