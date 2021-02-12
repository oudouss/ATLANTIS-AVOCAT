<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('type');
            $table->string('title');
            $table->string('name');
            $table->string('adress');
            $table->string('cp');
            $table->string('city');
            $table->string('country');
            $table->string('work')->nullable();
            $table->string('cin')->nullable();
            $table->string('phone')->nullable();
            $table->string('fix')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
