<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = new Player;
        $a->name = "Philimore";
        $a->gamertag = "Destroyotron";
        $a->date_of_birth = '2001-12-25';
        $a->save();
    }
}
