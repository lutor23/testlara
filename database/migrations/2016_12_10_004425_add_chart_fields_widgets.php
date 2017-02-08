<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChartFieldsWidgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('chartwidgets');

        Schema::table('widgets', function (Blueprint $table) {
            $table->string('chart_category')->nullable();
            $table->string('chart_type')->nullable();
            $table->string('chart_library')->nullable();
            $table->string('chart_labels')->nullable();
            $table->string('chart_values')->nullable();
            $table->string('chart_dataset')->nullable();
            $table->integer('chart_dimensionx')->nullable();
            $table->integer('chart_dimensiony')->nullable();
            $table->integer('chart_responsive')->default(0);
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
            $table->dropColumn('chart_category');
            $table->dropColumn('chart_type');
            $table->dropColumn('chart_library');
            $table->dropColumn('chart_labels');
            $table->dropColumn('chart_values');
            $table->dropColumn('chart_dataset');
            $table->dropColumn('chart_dimensionx');
            $table->dropColumn('chart_dimensiony');
            $table->dropColumn('chart_responsive');

        });
    }
}
