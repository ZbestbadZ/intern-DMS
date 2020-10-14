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
            AdminSeeder::class,
            UserSeeder::class,
            ItemSeeder::class,
            UserImageSeeder::class,
            UserLikeSeeder::class,
            UserBlockSeeder::class,
            UserReportSeeder::class,
            UserSeeder::class,
            UserHobbySeeder::class
        ];

        $this->call($classes); 
    }
}
