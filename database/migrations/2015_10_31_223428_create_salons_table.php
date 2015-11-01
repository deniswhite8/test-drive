<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dealer_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('work_time');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('dealer_id')
                ->references('id')->on('dealers')
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
        Schema::drop('salons');
    }
}
