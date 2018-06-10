<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserAddress::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'region' => $faker->city,
        'city' => $faker->city,
        'address1' => $faker->streetAddress,
        'address2' => $faker->streetAddress,
        'postcode' => $faker->postcode,
        'status' => $faker->boolean,
    ];
});
