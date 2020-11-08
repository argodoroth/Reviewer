<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$reviews = Review::factory()->count(3)->create();
        
        $a = new Review;
        $a->Title = "Great game, too short";
        $a->description = "Gameplay was amazing, but unfortunately story was short";
        $a->date_posted = '2014-10-09';
        $a->rating = 10;
        $a->game_id =1;
        $a->save();
        
    }
}
