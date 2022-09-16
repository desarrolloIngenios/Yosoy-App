<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_rating', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->integer('user_id');
            $table->integer('created_by');
            $table->integer('star_rating_item');
            $table->integer('rating');

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
        Schema::dropIfExists('star_rating');
    }
}
