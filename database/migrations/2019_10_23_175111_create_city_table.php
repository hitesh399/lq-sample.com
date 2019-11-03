<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->increments('id');
                $table->smallInteger('country_id')->unsigned();

                $table->foreign('country_id')
                    ->references('id')->on('countries')
                    ->onDelete('cascade');

                $table->integer('region_id')->unsigned();

                $table->foreign('region_id')
                        ->references('id')->on('regions')
                        ->onDelete('cascade');
                $table->decimal('latitude', 11, 8)->nullable();
                $table->decimal('longitude', 11, 8)->nullable();
                $table->string('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
