<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stade_id')->unsigned()->nullable();
            $table->bigInteger('lawsuit_id')->unsigned()->nullable();
            $table->string('name');
            $table->longText('url');
            $table->foreign('stade_id')->references('id')->on('stades')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('lawsuit_id')->references('id')->on('lawsuits')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachements');
    }
}
