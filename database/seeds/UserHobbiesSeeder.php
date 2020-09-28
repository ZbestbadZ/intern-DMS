<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHobbiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_hobbies')->insert([
            'user_id'=> '1',
            'hobby'=> '1',
        ]);

        DB::table('user_hobbies')->insert([
            'user_id'=> '2',
            'hobby'=> '2',
        ]);

        DB::table('user_hobbies')->insert([
            'user_id'=> '3',
            'hobby'=> '3',
        ]);

        DB::table('user_hobbies')->insert([
            'user_id'=> '4',
            'hobby'=> '4',
        ]);

        DB::table('user_hobbies')->insert([
            'user_id'=> '5',
            'hobby'=> '5',
        ]);
    }
}
