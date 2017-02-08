<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('connections', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::table('dashboards', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::table('datasources', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::table('directors', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });                


        Schema::table('teams', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::table('urls', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::table('widgets', function (Blueprint $table) {
            $table->integer('user_id')->default('1');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connections', function (Blueprint $table) {
            $table->dropForeign('connections_user_id_foreign');            
            $table->dropColumn('user_id');
        });
        
        Schema::table('dashboards', function (Blueprint $table) {
            $table->dropForeign('dashboards_user_id_foreign');                        
            $table->dropColumn('user_id');
        });

        Schema::table('datasources', function (Blueprint $table) {
            $table->dropForeign('datasources_user_id_foreign');                        
            $table->dropColumn('user_id');
        });

        Schema::table('directors', function (Blueprint $table) {
            $table->dropForeign('directors_user_id_foreign');                        
            $table->dropColumn('user_id');
        });                


        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign('teams_user_id_foreign');                        
            $table->dropColumn('user_id');
        });
        
        Schema::table('urls', function (Blueprint $table) {
            $table->dropForeign('urls_user_id_foreign');                        
            $table->dropColumn('user_id');
        });

        Schema::table('widgets', function (Blueprint $table) {
            $table->dropForeign('widgets_user_id_foreign');                        
            $table->dropColumn('user_id');
        });
    }
}
