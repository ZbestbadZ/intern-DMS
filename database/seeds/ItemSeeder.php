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
                'item_price'=> '100',
                'image_path'=> 'img/item1_image.png',
            ]);
        }
        DB::table('items')->insert([
            'name'=> 'name_item1',
            'item_price'=> '100',
            'image_path'=> 'img/item1_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item2',
            'item_price'=> '101',
            'image_path'=> 'img/item2_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item3',
            'item_price'=> '102',
            'image_path'=> 'img/item3_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item4',
            'item_price'=> '103',
            'image_path'=> 'img/item4_image.png',
        ]);

        DB::table('items')->insert([
            'name'=> 'name_item5',
            'item_price'=> '104',
            'image_path'=> 'img/item5_image.png',
        ]);
    }
}
