<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('cargo_id');
            $table->integer('sector_id');
            $table->integer('ciudad_id');
            $table->integer('nivel_educativo_id');
            $table->integer('tiempo_experiencia_id');


            $table->timestamps();
            $table->softDeletes();

            $table->index('cargo_id');
            $table->index('sector_id');
            $table->index('ciudad_id');
            $table->index('nivel_educativo_id');
            $table->index('tiempo_experiencia_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer');
    }
}
