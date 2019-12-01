<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(App\Transfer::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit(),
        'account_id' => $faker->randomDigit(),
        'sender_account_number' => 'LT'.rand(1000000000,9999999999),
        'receiver_account_number' => 'LT'.rand(1000000000,9999999999),
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 900),
    ];
});