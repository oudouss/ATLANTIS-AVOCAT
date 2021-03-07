<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lawsuit_id')->unsigned();
            $table->date('paid_at')->nullable();
            
            $table->string('type');
            $table->string('tax')->nullable();
            $table->string('creance')->nullable();
            $table->string('ice')->nullable();
            
            $table->integer('number');
            $table->string('serie')->nullable();
            $table->date('date');
            $table->integer('days');

            $table->longtext('item1');
            $table->string('unit1')->nullable();
            $table->integer('qty1')->nullable();
            $table->integer('price1');

            $table->longtext('item2')->nullable();
            $table->string('unit2')->nullable();
            $table->integer('qty2')->nullable();
            $table->integer('price2')->nullable();


            $table->longtext('item3')->nullable();
            $table->string('unit3')->nullable();
            $table->integer('qty3')->nullable();
            $table->integer('price3')->nullable();

            $table->longtext('item4')->nullable();
            $table->string('unit4')->nullable();
            $table->integer('qty4')->nullable();
            $table->integer('price4')->nullable();

            $table->longtext('note')->nullable();
            $table->integer('total_amount')->nullable();
            $table->longText('pdf')->nullable();
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
        Schema::dropIfExists('billings');
    }
}
