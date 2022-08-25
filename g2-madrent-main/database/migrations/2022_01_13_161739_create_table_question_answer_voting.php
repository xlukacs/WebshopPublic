<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuestionAnswerVoting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("question_text")->default('null');
            $table->date("date_from")->useCurrent();
            $table->date("date_to")->useCurrent();
        });
        
        Schema::create('answer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer("question_id")->default(0);
            $table->integer("answer_text")->default('null');
        });
        
        Schema::create('voting', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->integer("user_id")->default(0);
            $table->integer("answer_id")->default(0);
            $table->date("date")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question');
        Schema::dropIfExists('answer');
        Schema::dropIfExists('voting');
    }
}
