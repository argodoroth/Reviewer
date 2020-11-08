<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();    //makes some users
        \App\Models\Player::factory(10)->create();  //makes some players
        $this->call(GameTableSeeder::class);    //makes games, and reviews as children of games
        //$this->call(ReviewTableSeeder::class);

    }
}
