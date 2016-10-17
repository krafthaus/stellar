<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('lft')->unsigned();
            $table->integer('rgt')->unsigned();
            $table->integer('order')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('classname');
            $table->text('values')->nullable();
            $table->timestamps();

            $table->index(['parent_id', 'lft', 'rgt', 'order', 'classname']);

            $table->foreign('page_id')
                ->references('id')->on('pages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widgets');
    }
}
