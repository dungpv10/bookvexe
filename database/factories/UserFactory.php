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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'dob' => $faker->time('Y-m-d'),
        'mobile' => $faker->phoneNumber,
        'gender' => array_rand([USER_GENDER_MALE, USER_GENDER_FEMALE]),
        'status' => array_rand(USER_STATUS_ACTIVE, USER_STATUS_IN_WORKING),
        'avatar' => $faker->imageUrl(200, 200),
        'address' => $faker->address,
        'remember_token' => str_random(10),
    ];
});
