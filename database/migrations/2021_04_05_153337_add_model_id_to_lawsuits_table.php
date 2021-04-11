<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModelIdToLawsuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawsuits', function (Blueprint $table) {
            $table->bigInteger('model_id')->unsigned()->nullable();
            $table->foreign('model_id')->references('id')->on('lawsuit_models')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lawsuits', function (Blueprint $table) {
            if (Schema::hasColumn('lawsuits', 'model_id')) {
                Schema::table('lawsuits', function ($table) {
                    $table->dropColumn('model_id');
                });
            }
        });
    }
}
