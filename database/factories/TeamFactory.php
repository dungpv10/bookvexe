<?php

/*
|--------------------------------------------------------------------------
| Team Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Team::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'agent_license' => 'license '. $faker->unique()->randomNumber(8)
    ];
});
