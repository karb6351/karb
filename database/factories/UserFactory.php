<?php

use Faker\Generator as Faker;
use App\User;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    $gender = $faker->randomElement(['male', 'female']);
    return [
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'gender' => $gender,
        'remember_token' => str_random(10),
    ];
});
