<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStadeNameIdToStadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stades', function (Blueprint $table) {
            $table->bigInteger('stade_name_id')->unsigned();
            $table->foreign('stade_name_id')->references('id')->on('stade_names')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stades', function (Blueprint $table) {
            if (Schema::hasColumn('stades', 'stade_name_id')) {
                Schema::table('stades', function ($table) {
                    $table->dropColumn('stade_name_id');
                });
            }
        });
    }
}
