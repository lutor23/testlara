<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('folder_url', function (Blueprint $table) {
            $table->integer('folder_id')->unsigned()->index();
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');

            $table->integer('url_id')->unsigned()->index();
            $table->foreign('url_id')->references('id')->on('urls')->onDelete('cascade');

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
        Schema::drop('folder_url');
        Schema::drop('folders');      
    }
}
