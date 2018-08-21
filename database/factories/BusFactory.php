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
        'user_id' => random_int(1, 4),
        'start_time' => '12:00:00',
        'amenities' => 'Nước uống, Wifi, Điều hoà',
        'end_time' => '15:00:00',
        'status' => array_rand([BUS_INACTIVE, BUS_ACTIVE, BUS_WORKING])
    ];


});
