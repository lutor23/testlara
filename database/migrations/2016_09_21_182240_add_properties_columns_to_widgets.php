<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertiesColumnsToWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->dropColumn('info_type');          
            $table->integer('size')->default(3);
            $table->string('threshold_operator');
            $table->string('threshold_value');
            $table->string('infobox_type');
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
            $table->dropColumn('size');
            $table->dropColumn('threshold_value');
            $table->dropColumn('threshold_operator');
            $table->dropColumn('infobox_type');
        });
    }
}
