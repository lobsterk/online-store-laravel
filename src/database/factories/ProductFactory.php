<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'category_id'=> $faker->numberBetween(1,10),
        'manufacturer_id'=> $faker->numberBetween(1,5),
        'title'=> $faker->sentence,
        'html_h1'=> $faker->sentence,
        'html_title'=> $faker->sentence,
        'meta_keywords'=> $faker->words(5, $asText = true),
        'meta_description'=> $faker->sentence(5),
        'description'=> $faker->sentence(5),
        'model'=> $faker->unique()->numberBetween(300000, 500000),
        'price'=> $faker->randomFloat(2, 500, 3000),
        'count'=> $faker->randomDigitNotNull,
        'status'=> $faker->boolean(90),
        'status'=> $faker->boolean(90),
        'created_by'=> 1,
    ];
});
