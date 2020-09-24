<?php

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
        $classes = [
            AdminSeeder::class;
            ItemSeeder::class,
            UserHobbiesSeeder::class,
            UserImageSeeder::class,
            UserLikeSeeder::class,
            UserSeeder::class
        ];

        $this->call($classes); 
    }
}
