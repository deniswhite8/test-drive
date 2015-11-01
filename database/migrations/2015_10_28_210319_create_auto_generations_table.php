<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_generations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('model_id')->unsigned();
            $table->integer('start_year_production');
            $table->integer('end_year_production')->nullable();
            $table->foreign('model_id')
                ->references('id')->on('auto_models')
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
        Schema::drop('auto_generations');
    }
}
