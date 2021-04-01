<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConventionIdToLawsuitsTable extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawsuits', function (Blueprint $table) {
            $table->bigInteger('convention_id')->unsigned()->nullable();
            $table->foreign('convention_id')->references('id')->on('conventions')->cascadeOnDelete()->cascadeOnUpdate();

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
            if (Schema::hasColumn('lawsuits', 'convention_id')) {
                Schema::table('lawsuits', function ($table) {
                    $table->dropColumn('convention_id');
                });
            }
        });
    }
}
