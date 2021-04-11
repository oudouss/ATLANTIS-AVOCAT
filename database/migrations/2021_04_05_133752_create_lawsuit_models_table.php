<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawsuitModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawsuit_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('procedure_id')->unsigned()->nullable();
            $table->foreign('procedure_id')->references('id')->on('procedures')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('lawsuit_models');
    }
}
