<?php

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
            'type'=> 'avatar',
            'path' => 'img/avatar.png'
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '2',
            'type'=> 'cover',
            'path' => 'img/cover.png'
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '3',
            'type'=> 'checkin1',
            'path' => 'img/checkin1.png'
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '4',
            'type'=> 'checkin2',
            'path' => 'img/checkin2.png'
        ]);

        DB::table('user_images')->insert([
            'user_id'=> '5',
            'type'=> 'checkin3',
            'path' => 'img/checkin3.png'
        ]);
    }
}
