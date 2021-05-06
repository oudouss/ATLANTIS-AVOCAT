<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHonorairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honoraires', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convention_id')->unsigned();
            $table->decimal('min_crc', 20, 2);
            $table->decimal('max_crc', 20, 2)->nullable();
            $table->boolean('type')->default(0);
            $table->decimal('amount', 20, 2)->nullable();
            $table->decimal('min', 20, 2)->nullable();
            $table->decimal('max', 20, 2)->nullable();
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
        Schema::dropIfExists('honoraires');
    }
}
