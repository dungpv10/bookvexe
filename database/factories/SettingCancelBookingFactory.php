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

$factory->define(App\Models\SettingCancelBooking::class, function (Faker\Generator $faker) {
    return [
        'cancel_time' => date('Y-m-d H:i:s'),
        'percentage' => random_int(5, 25),
        'flat' => random_int(100, 300) * 1000
    ];

});
