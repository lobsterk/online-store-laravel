<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->domainWord,
        'parent_id' => $faker->numberBetween(0,3),
        'display_menu' => $faker->boolean(90),
        'status' => $faker->boolean(90),
        'slug' => $faker->slug(3),
    ];
});
