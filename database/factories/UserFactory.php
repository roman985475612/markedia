<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name,
            'email'       => $this->faker->safeEmail,
            'description' => $this->faker->text(200),
            'password'    => $this->faker->md5,
            'thumbnail'   => 'user.png',
        ];
    }
}
