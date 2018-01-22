<?php

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

$factory->define(App\Reply::class, function (Faker $faker) {

    return [
        'content' => $faker->text($maxNbChars = 200),
        'post_id' => $faker->randomNumber($nbDigits = 2) + 22,
        'user_id' => $faker->randomNumber($nbDigits = 2) % 40 + 20,
    ];
});
