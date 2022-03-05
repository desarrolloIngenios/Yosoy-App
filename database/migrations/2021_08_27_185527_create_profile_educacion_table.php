<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileEducacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_educacion', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->string('titulo');
            $table->string('institucion');
            $table->integer('nivel_educativo_id');
            $table->integer('pais_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('profile_id');
            $table->index('nivel_educativo_id');
            $table->index('pais_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_educacion');
    }
}
