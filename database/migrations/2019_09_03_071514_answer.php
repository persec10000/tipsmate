<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Answer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('userimage');
            $table->string('image_name');
            $table->text('answer');
            $table->integer('question_id');
            $table->integer('following');
            $table->dateTime('register_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer');
    }
}
