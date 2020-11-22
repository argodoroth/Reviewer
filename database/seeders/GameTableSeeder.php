<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates a game with a review child, giving it a game id
        Game::factory()->count(20)->
        has(\App\Models\Review::factory()->count(3))->create();
        
        //get all 
        $players = \App\Models\Player::all();
        
        //For each on games, grab 5-10 random playerrs and attaches to each game
        //populating the pivot table
        \App\Models\Game::all()->each(function ($game) use ($players) {
            $game->players()->attach(
                $players->random(rand(5,10))->pluck('id')->toArray()
            );
        });
    }
}
