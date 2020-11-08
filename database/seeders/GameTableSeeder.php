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
        Game::factory()->count(20)->
        has(\App\Models\Review::factory()->count(3))->create();
        
        //get all 
        $users = \App\Models\User::all();
        
        //For each on games, grab 5-10 random users and attach
        \App\Models\Game::all()->each(function ($game) use ($users) {
            $game->users()->attach(
                $users->random(rand(5,10))->pluck('id')->toArray()
            );
        });
        /*
        $a = new Game;
        $a->name = "Skyrim";
        $a->developer = "Bethesda Game Studios";
        $a->publisher = "Bethesda";
        $a->release_date = '2011-11-11';
        $a->save();

        $b = new Game;
        $b->name = "Grand Theft Auto";
        $b->developer = "Rockstar Games";
        $b->publisher = "Rockstar";
        $b->release_date = '1997-10-21';
        $b->save();
        */
    }
}
