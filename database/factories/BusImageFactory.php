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

$factory->define(App\Models\Bus::class, function (Faker\Generator $faker) {

    return [
        'bus_name' => $faker->name,
        'bus_reg_number' => '30F-' . $faker->randomDigit,
        'number_seats' => random_int(30, 40),
        'start_point' => $faker->countryCode,
        'end_point' => $faker->countryCode,
        'start_time' => 0,
        'end_time' => random_int(2, 23)
    ];
});