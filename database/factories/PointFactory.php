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

$factory->define(App\Models\Point::class, function (Faker\Generator $faker) {
    $routes = \App\Models\Route::pluck('id');
    return [
        'drop_time' => '12:00:00',
        'address' => $faker->address,
        'landmark' => $faker->address,
        'route_id' => $routes->random()
    ];
});
