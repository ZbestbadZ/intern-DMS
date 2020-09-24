<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('123'),
        ]);
        DB::table('admins')->insert([
            'username'=> 'admin1',
            'email'=> 'admin1@gmail.com',
            'password'=> bcrypt('123'),
        ]);
        DB::table('admins')->insert([
            'username'=> 'admin2',
            'email'=> 'admin2@gmail.com',
            'password'=> bcrypt('123'),
        ]);
        DB::table('admins')->insert([
            'username'=> 'admin3',
            'email'=> 'admin3@gmail.com',
            'password'=> bcrypt('123'),
        ]);
        DB::table('admins')->insert([
            'username'=> 'admin4',
            'email'=> 'admin4@gmail.com',
            'password'=> bcrypt('123'),
        ]);
        DB::table('admins')->insert([
            'username'=> 'admin5',
            'email'=> 'admin5@gmail.com',
            'password'=> bcrypt('123'),
        ]);
    }
}
