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
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '2',
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '3',
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '4',
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '5',
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '6',
            ]);
        }
        DB::table('user_likes')->insert([
            'user_id'=> '2',
            'target_id'=> '3',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '3',
            'target_id'=> '4',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '4',
            'target_id'=> '5',
        ]);

        DB::table('user_likes')->insert([
            'user_id'=> '5',
            'target_id'=> '6',
        ]);
    }
}
