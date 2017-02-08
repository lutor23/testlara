<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsConnIdsInDatasourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datasources', function (Blueprint $table) {
            $table->string('ds_type');
            $table->integer('connection_id')->unsigned()->nullable();
            $table->foreign('connection_id')->references('id')->on('connections')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datasources', function (Blueprint $table) {
            $table->dropForeign('datasources_connection_id_foreign');
            $table->dropColumn('ds_type');
            $table->dropColumn('connection_id');
        });
    }
}
