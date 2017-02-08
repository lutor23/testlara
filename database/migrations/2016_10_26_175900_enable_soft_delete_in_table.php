<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnableSoftDeleteInTable extends Migration
{
    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $tables=array('connections', 'dashboards', 'datasources', 'directors', 'folders', 'teams', 'urls', 'widgets', 'cache_datasource_stats');

        foreach ($tables as $item) { 
            Schema::table($item, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    $tables=array('connections', 'dashboards', 'datasources', 'directors', 'folders', 'teams', 'urls', 'widgets', 'cache_datasource_stats');

        foreach ($tables as $item) { 
            Schema::table($item, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }

    }
}
