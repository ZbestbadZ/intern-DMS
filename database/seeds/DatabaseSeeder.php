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
            UserBlockSeeder::class,
            UserReportSeeder::class,
            UserHobbiesSeeder::class,
            UserImageSeeder::class,
            UserLikeSeeder::class,
            ItemSeeder::class
        ];

        $this->call($classes); 
    }
}
