<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCacheDatasourceStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache_datasource_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->json('output');
            $table->integer('datasource_id')->unsigned();
            $table->foreign('datasource_id')->references('id')->on('datasources')->onDelete('cascade');            
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
        Schema::dropIfExists('cache_datasource_stats');
    }
}
