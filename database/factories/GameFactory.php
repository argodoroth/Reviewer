<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userCount = \App\Models\User::all()->count();
        return [
            'name' => $this->faker->name,
            'publisher' => $this->faker->name,
            'developer' => $this->faker->name,
            'release_date' => $this->faker->dateTime,
            'user_id' => $this->faker->numberBetween(1,$userCount)
        ];
    }
}
