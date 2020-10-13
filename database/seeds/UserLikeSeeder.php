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
        for ($k=10; $k <= 110 ; $k+=10) { 
            for ($i=1; $i < 11; $i++) { 
                DB::table('user_likes')->insert([
                    'user_id'=> $i+$k,
                    'target_id'=> $k/10,
                    'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]);
                
            }
        }
        
     
    }
}
