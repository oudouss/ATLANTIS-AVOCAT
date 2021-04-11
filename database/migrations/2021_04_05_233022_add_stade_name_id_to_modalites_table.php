<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStadeNameIdToModalitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modalites', function (Blueprint $table) {
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
        Schema::table('modalites', function (Blueprint $table) {
            if (Schema::hasColumn('modalites', 'stade_name_id')) {
                Schema::table('modalites', function ($table) {
                    $table->dropColumn('stade_name_id');
                });
            }
        });
    }
}
