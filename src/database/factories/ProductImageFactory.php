<?php

use Faker\Generator as Faker;



$factory->define(App\Models\ProductImage::class, function (Faker $faker ) {

    $filepath = storage_path('images');

    if(!File::exists($filepath)){
        File::makeDirectory($filepath);  //follow the declaration to see the complete signature
    }

    return [
        'product_id' => $faker->numberBetween(1,100),
        'file_name' => $faker->image($filepath,400,300, 'fashion', false),
        'path' => $filepath,
        'sort_order' => $faker->numberBetween(1,10),
    ];
});
