<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferQuestionResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_question_response', function (Blueprint $table) {
            $table->id();
            $table->integer('star_response')->nullable();
            $table->text('text_response');
            $table->integer('offer_question_id');
            $table->string('offer_question_type');
            $table->integer('created_by');
            $table->integer('offer_id');
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
        Schema::dropIfExists('offer_question_response');
    }
}
