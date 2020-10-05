<?php

use Carbon\Carbon;
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
                'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '3',
                'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '4',
                'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '5',
                'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
        for ($i=1; $i < 11; $i++) { 
            DB::table('user_likes')->insert([
                'user_id'=> $i,
                'target_id'=> '6',
                'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        }
     
    }
}
