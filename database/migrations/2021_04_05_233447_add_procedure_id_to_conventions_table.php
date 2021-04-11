<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcedureIdToConventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conventions', function (Blueprint $table) {
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
        Schema::table('conventions', function (Blueprint $table) {
            if (Schema::hasColumn('conventions', 'procedure_id')) {
                Schema::table('conventions', function ($table) {
                    $table->dropColumn('procedure_id');
                });
            }
        });
    }
}
