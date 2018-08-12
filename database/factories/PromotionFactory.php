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

$factory->define(App\Models\Promotion::class, function (Faker\Generator $faker) {
    return [
        'code' => 'Code-' . $faker->postcode,
        'amount' => random_int(10, 20),
        'status' => array_rand([PROMOTION_ACTIVE, PROMOTION_DEACTIVE]),
        'expiry_date' => $faker->time('Y-m-d H:i:s'),
        'promotion_type' => array_rand([PROMOTION_FOR_CUSTOMER, PROMOTION_NEW_CUSTOMER, PROMOTION_OLD_CUSTOMER])
    ];

});
