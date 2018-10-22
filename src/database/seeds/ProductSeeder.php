<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\Product', 100)->create();
        factory('App\Models\ProductImage', 100)->create();
    }
}
