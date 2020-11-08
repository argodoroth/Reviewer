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
        //Creates a game with a child review, giving it a game id
        Game::factory()->count(20)->
        has(\App\Models\Review::factory()->count(3))->create();
        
        //get all 
        $users = \App\Models\User::all();
        
        //For each on games, grab 5-10 random users and attaches to each game
        //populating the pivot table
        \App\Models\Game::all()->each(function ($game) use ($users) {
            $game->users()->attach(
                $users->random(rand(5,10))->pluck('id')->toArray()
            );
        });
    }
}
