<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawsuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawsuits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('opponent_id')->unsigned();
            $table->string('caseType')->nullable();
            $table->string('caseNum');
            $table->string('fileNum')->unique();
            $table->string('procedure');
            $table->string('state');
            $table->date('acceptation');
            $table->boolean('curateur')->default(0);
            $table->decimal('creance', 20, 2)->nullable();
            $table->date('classement')->nullable();
            $table->date('archivage')->nullable();
            $table->longText('notes')->nullable();
            $table->foreign('client_id')->references('id')->on('contacts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('opponent_id')->references('id')->on('contacts')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('lawsuits');
    }
}
