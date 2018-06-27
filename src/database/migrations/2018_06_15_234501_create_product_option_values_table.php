<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_option_id')->unsigned();
            $table->string('title');
            $table->string('image');
            $table->integer('sort_order');
            $table->timestamps();

            $table->foreign('product_option_id')
                ->references('id')->on('product_options')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_option_values', function (Blueprint $table) {
            $table->dropForeign('product_option_values_product_option_id_foreign');
        });
        Schema::dropIfExists('product_option_values');
    }
}
