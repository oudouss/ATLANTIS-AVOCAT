<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcedureIdToLawsuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lawsuits', function (Blueprint $table) {
            $table->bigInteger('procedure_id')->unsigned();
            $table->foreign('procedure_id')->references('id')->on('procedures')->cascadeOnDelete()->cascadeOnUpdate();

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
            if (Schema::hasColumn('lawsuits', 'procedure_id')) {
                Schema::table('lawsuits', function ($table) {
                    $table->dropColumn('procedure_id');
                });
            }
        });
    }
}
