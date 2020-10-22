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
            ProductSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            UserBlockSeeder::class,
            UserReportSeeder::class,
            UserImageSeeder::class,
            UserLikeSeeder::class,
            UserHobbySeeder::class,
            ItemSeeder::class
        ];

        $this->call($classes);

   }
}