<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelStadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_stades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('model_id')->unsigned();
            $table->bigInteger('current_id')->unsigned();
            $table->boolean('first')->default(0);
            $table->boolean('last')->default(0);
            $table->bigInteger('previous_id')->unsigned()->nullable();
            $table->bigInteger('next_id')->unsigned()->nullable();
            $table->foreign('model_id')->references('id')->on('lawsuit_models')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('previous_id')->references('id')->on('stade_names')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('current_id')->references('id')->on('stade_names')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('next_id')->references('id')->on('stade_names')->cascadeOnDelete()->cascadeOnUpdate();
            
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
        Schema::dropIfExists('model_stades');
    }
}
