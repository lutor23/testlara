<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChartsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chartoptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('charttype');
            $table->string('library');
            $table->integer('single')->default(1);
            $table->integer('multiple')->default(0);
            $table->integer('realtime')->default(0);
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
        Schema::dropIfExists('chartoptions');
    }
}
