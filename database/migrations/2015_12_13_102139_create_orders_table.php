<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mark_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('generation_id')->unsigned()->nullable();
            $table->integer('salon_id')->unsigned();
            $table->text('contacts');
            $table->dateTime('datetime');
            $table->mediumText('comment')->nullable();
            $table->timestamps();

            $table->foreign('mark_id')
                ->references('id')->on('auto_marks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('model_id')
                ->references('id')->on('auto_models')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('generation_id')
                ->references('id')->on('auto_generations')
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
        Schema::drop('orders');
    }
}
