<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLawsuitIdToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->bigInteger('lawsuit_id')->unsigned()->nullable()->after('user_id');
            $table->foreign('lawsuit_id')->references('id')->on('lawsuits')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'lawsuit_id')) {
                Schema::table('events', function ($table) {
                    $table->dropColumn('lawsuit_id');
                });
            }
        });
    }
}
