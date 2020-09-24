<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_likes')->insert([
            'user_id'=> '1',
            'targer_id'=> '2',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '2',
            'targer_id'=> '3',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '3',
            'targer_id'=> '4',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '4',
            'targer_id'=> '5',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '5',
            'targer_id'=> '6',
        ]);
    }
}
