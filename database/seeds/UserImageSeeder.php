<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_images')->insert([
            'user_id'=> '1',
            'type'=> '1',
            'path' => 'img/avatar.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '2',
            'type'=> '2',
            'path' => 'img/cover.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '3',
            'type'=> '2',
            'path' => 'img/checkin1.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '4',
            'type'=> '2',
            'path' => 'img/checkin2.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '5',
            'type'=> '2',
            'path' => 'img/checkin3.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
