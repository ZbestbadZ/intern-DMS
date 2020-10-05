<?php

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
        for ($i=0; $i<20 ; $i++) { 
            DB::table('items')->insert([
                'name'=> 'name_item'.($i+1),
                'price'=> '100',
                'path'=> 'img/item1_image.png',
            ]);
        }
       
    }
}
