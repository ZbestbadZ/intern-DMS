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
            UserBlockSeeder::class,
            UserReportSeeder::class,
            AdminSeeder::class,
            ItemSeeder::class,
            UserImageSeeder::class,
            UserLikeSeeder::class,
            UserSeeder::class,
            UserHobbySeeder::class
        ];

        $this->call($classes); 
    }
}
