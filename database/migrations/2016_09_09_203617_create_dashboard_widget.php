<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardWidget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_widget', function (Blueprint $table) {
            $table->integer('dashboard_id')->unsigned();
            $table->foreign('dashboard_id')->references('id')->on('dashboards')->onDelete('cascade');

            $table->integer('widget_id')->unsigned();
            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');

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
        Schema::dropIfExists('dashboard_widget');
    }
}
