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
        $games = Game::factory()->count(3)->create();
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
