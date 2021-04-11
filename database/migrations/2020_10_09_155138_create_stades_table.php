<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lawsuit_id')->unsigned();
            $table->date('date');
            $table->boolean('state')->default(0);
            $table->longText('observation')->nullable();
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
        Schema::dropIfExists('stades');
    }
}
