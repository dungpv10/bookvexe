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

$factory->define(App\Models\Rate::class, function (Faker\Generator $faker) {

    return [
        'rating_number' => random_int(1, 5),
        'comment' => 'Your service is very good'
    ];
});
