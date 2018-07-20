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

$factory->define(App\Models\SeatLayout::class, function (Faker\Generator $faker) {
    return [
        'seat_type_id' => array_rand(array_keys(config('bus.seat_type'))),
        'total_seat' => random_int(20, 45),
        'layout_id' => array_rand(array_keys(config('bus.layout_type')))
    ];

});
