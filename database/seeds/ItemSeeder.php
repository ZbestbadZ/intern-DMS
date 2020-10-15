<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=20 ; $i++) { 
            DB::table('items')->insert([
                'name'=> 'name_item'.($i+1),
                'price'=> '100',
                'path'=> 'uploads/sticker/demo_defaut_sticker/'.($i+1).'.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
       
    }
}
