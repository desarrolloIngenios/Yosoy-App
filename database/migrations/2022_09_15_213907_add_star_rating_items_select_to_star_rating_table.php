<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStarRatingItemsSelectToStarRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_rating', function (Blueprint $table) {
            $table->dropColumn('star_rating_item');
            $table->text('comment')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('star_rating', function (Blueprint $table) {
            $table->integer('star_rating_item')->nullable();
            $table->dropColumn('comment');
        });
    }
}
