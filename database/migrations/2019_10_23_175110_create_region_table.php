<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('regions')) {
            Schema::create('regions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('code', 10);
                $table->smallInteger('country_id')->unsigned();

                $table->foreign('country_id')
                    ->references('id')->on('countries')
                    ->onDelete('cascade');

                $table->unique(['code', 'country_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
