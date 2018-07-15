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

$factory->define(App\Models\BusImage::class, function (Faker\Generator $faker) {

    return [
        'image_path' => $faker->imageUrl(200, 200)
    ];
});
