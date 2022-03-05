<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePerfilLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_perfil_laboral', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('cargo_id');
            $table->integer('nivel_experiencia_id');
            $table->integer('tiempo_experiencia_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('profile_id');
            $table->index('cargo_id');
            $table->index('nivel_experiencia_id');
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
        Schema::dropIfExists('profile_perfil_laboral');
    }
}
