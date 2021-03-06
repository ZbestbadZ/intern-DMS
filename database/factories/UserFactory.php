<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username'=>$faker->name,
        'address'=>$faker->address,
        'phone' => $faker->e164PhoneNumber,
        'sex' => rand(0,1),
        'birthday' => $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-20 years', $timezone = null),
        'job' =>rand(1,47),
        'height' =>rand(130,200),
        'figure' =>rand(1,7),
        'alcohol' =>rand(1,4),
        'tabaco' =>rand(1,5),
        'anual_income'=>rand(1,8),
        'matching_expect'=>rand(1,5),
        'holiday'=>rand(1,5),
        'aca_background'=>rand(1,6),
        'housemate' => rand(1,6),
        'birthplace' =>rand(1,47),
        'tabaco' =>rand(1,5),
        'alcohol' =>rand(1,4),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('123'),
        'pickup_status' => rand(0,1),
        'remember_token' => Str::random(10),
        'api_token'=>Str::orderedUuid()
    ];
});
