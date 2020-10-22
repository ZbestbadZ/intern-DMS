<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('orders')->insert([
                'cus_phone' => $faker->tollFreePhoneNumber,
                'cus_name' => $faker->name,
                'cus_address' => $faker->address,
                'status' => 0,
                'total_price' => rand(500, 1000),
                'note' => $faker->text
            ]);
        }
    }
}