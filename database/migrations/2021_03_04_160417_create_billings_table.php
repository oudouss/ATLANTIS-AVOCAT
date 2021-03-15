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
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('creance', 20, 2)->nullable();

            $table->string('ice')->nullable();
            
            $table->integer('number')->nullable();
            $table->string('serie')->nullable();
            $table->date('date');
            $table->decimal('days', 8, 2)->nullable();

            $table->longtext('item1');
            $table->string('unit1')->nullable();
            $table->decimal('qty1', 8, 2)->nullable();
            $table->decimal('price1', 20, 2)->nullable();

            $table->longtext('item2')->nullable();
            $table->string('unit2')->nullable();
            $table->decimal('qty2', 8, 2)->nullable();
            $table->decimal('price2', 20, 2)->nullable();


            $table->longtext('item3')->nullable();
            $table->string('unit3')->nullable();
            $table->decimal('qty3', 8, 2)->nullable();
            $table->decimal('price3', 20, 2)->nullable();

            $table->longtext('item4')->nullable();
            $table->string('unit4')->nullable();
            $table->decimal('qty4', 8, 2)->nullable();
            $table->decimal('price4', 20, 2)->nullable();

            $table->longtext('note')->nullable();
            $table->decimal('total_amount', 20, 2)->nullable();
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
