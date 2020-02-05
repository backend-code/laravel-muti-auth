<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker\Generator $faker) {
    return [
        'first_name' =>  $faker->first_name,
        'last_name' =>  $faker->last_name,
        'token_type' =>  $faker->token_type,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'password_confirmation' => $faker->password_confirmation,
        'remember_token' => str_random(10),
    ];
});
