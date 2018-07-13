<?php

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

$factory->define(App\Models\Route::class, function (Faker\Generator $faker) {

    return [
        'price' => random_int(300, 400),
        'from_place' => $faker->countryCode,
        'arrived_place' => $faker->countryCode,
        'start_time' => 0,
        'arrived_time' => random_int(2, 23)
    ];
});