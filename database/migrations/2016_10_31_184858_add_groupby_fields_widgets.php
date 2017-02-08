<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupbyFieldsWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->string('groupby_field')->nullable();
            $table->string('groupby_operator')->nullable();
            $table->string('groupby_opfield')->nullable();
            $table->string('units')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn('groupby_field');
            $table->dropColumn('groupby_operator');
            $table->dropColumn('groupby_opfield');
            $table->dropColumn('units');
        });
    }
}
