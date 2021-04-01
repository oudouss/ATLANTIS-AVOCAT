<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convention_id')->unsigned();
            $table->string('bill_type');
            $table->longtext('name')->unique();
            $table->string('stade_name');
            $table->boolean('type')->default(0);
            $table->decimal('amount', 20, 2)->nullable();
            $table->decimal('days', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->foreign('convention_id')->references('id')->on('conventions')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('modalites');
    }
}
