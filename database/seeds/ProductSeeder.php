<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('products')->insert([
                'name' => 'product_name ' . $i,
                'price' => rand(20, 100),
                'quantity_in_stock' => rand(20, 50),
                'description' => 'This is Product ' . $i,
            ]);
        }
    }
}