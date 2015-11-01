<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalonAuto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_auto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auto_id')->unsigned();
            $table->integer('salon_id')->unsigned();

            $table->foreign('auto_id')
                ->references('id')->on('autos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('salon_id')
                ->references('id')->on('salons')
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
        Schema::drop('salon_auto');
    }
}
