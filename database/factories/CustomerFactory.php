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

$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {

    return [
        'customer_name' => $faker->userName,
        'email' => $faker->safeEmail,
        'number_phone' => $faker->phoneNumber,
        'age' => random_int(0, 99),
        'gender' => array_rand([USER_GENDER_FEMALE, USER_GENDER_MALE], 1),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];


});
