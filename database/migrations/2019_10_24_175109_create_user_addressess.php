<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressess extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->smallInteger('country_id')->unsigned();
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');

            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')
                ->references('id')->on('regions')
                ->onDelete('cascade');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');
            $table->char('postal_code', 10);
            $table->string('landmark')->defaul('');
            $table->string('address_line_1')->defaul('');
            $table->string('address_line_2')->defaul('');
            $table->decimal('_lat', 18, 8)->nullable();
            $table->decimal('_long', 18, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
