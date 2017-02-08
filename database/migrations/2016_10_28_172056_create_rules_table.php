<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->unsigned();
            $table->string('keyvalue');
            $table->string('operator');
            $table->string('threshold');
            $table->string('warnlevel');
            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rules');
    }
}
