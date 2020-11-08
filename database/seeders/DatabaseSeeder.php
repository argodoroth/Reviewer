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
        \App\Models\User::factory(10)->create();
        \App\Models\Player::factory(10)->create();
        $this->call(GameTableSeeder::class);
        //$this->call(ReviewTableSeeder::class);

    }
}
