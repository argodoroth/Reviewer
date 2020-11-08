<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $userCount = \App\Models\User::all()->count();
        return [
            'Title' => $this->faker->realText(50,1),
            'Description' => $this->faker->realText(200,2),
            'rating' => $this->faker->numberBetween(1,10),
            'date_posted' => $this->faker->dateTime,
            'user_id' => $this->faker->numberBetween(1,$userCount)
            //Will give a random value for user id
        ];
    }
}
