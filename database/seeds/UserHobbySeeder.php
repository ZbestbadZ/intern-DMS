<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 24; $i++) {
            DB::table('user_hobbies')
                ->insert([
                    'user_id' => $i,
                    'hobby' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                DB::table('user_hobbies')
                ->insert([
                    'user_id' => $i,
                    'hobby' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
        }
       
    }
}
