<?php

use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('order_details')->insert([
                'order_id' => $i,
                'product_id' => $i + 1,
                'quantity' => rand(1, 10),
                'price' => rand(50, 100),
            ]);
        }
    }
}