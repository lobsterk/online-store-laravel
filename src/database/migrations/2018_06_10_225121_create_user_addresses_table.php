<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('region');
            $table->string('city');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('postcode')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign('user_addresses_user_id_foreign');
        });
        Schema::dropIfExists('user_addresses');
    }
}
