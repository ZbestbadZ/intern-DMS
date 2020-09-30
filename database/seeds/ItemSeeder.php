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
                'name'=> 'name_item'.(5+1),
                'price'=> '100',
                'path'=> 'img/item1_image.png',
            ]);
        }
        DB::table('items')->insert([
            'name'=> 'name_item1',
            'price'=> '100',
            'path'=> 'img/item1_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item2',
            'price'=> '101',
            'path'=> 'img/item2_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item3',
            'price'=> '102',
            'path'=> 'img/item3_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item4',
            'price'=> '103',
            'path'=> 'img/item4_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item5',
            'price'=> '104',
            'path'=> 'img/item5_image.png',
        ]);
    }
}
