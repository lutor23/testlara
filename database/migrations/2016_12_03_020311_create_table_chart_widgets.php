<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChartWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chartwidgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('widget_id')->unsigned();
            
            $table->string('category');
            $table->string('type');
            $table->string('library');
            $table->string('labels');
            $table->string('values');
            $table->string('dataset');
            $table->integer('dimensionx')->nullable();
            $table->integer('dimensiony')->nullable();
            $table->integer('responsive')->default(0);

            $table->string('rt_valuename');
            $table->string('rt_url');
            $table->string('rt_height');
            $table->string('rt_width');
            $table->string('rt_min');
            $table->string('rt_max');
            $table->integer('rt_interval')->nullable();



            $table->timestamps();

            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chartwidgets');
    }
}
