<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates a game with a review child, giving it a game id using factories
        User::factory()->count(10)->
        has(\App\Models\Player::factory()->count(1))->create();    
    }
}
