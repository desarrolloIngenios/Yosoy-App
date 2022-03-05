<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileExperienciaLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_experiencia_laboral', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id');
            $table->integer('cargo_id');
            $table->integer('empleador_id');
            $table->integer('sector_id');
            $table->integer('pais_id');
            $table->integer('ciudad_id');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin')->nullable();
            $table->boolean('is_actual');
            $table->timestamps();
            $table->softDeletes();

            $table->index('profile_id');
            $table->index('cargo_id');
            $table->index('empleador_id');
            $table->index('sector_id');
            $table->index('pais_id');
            $table->index('ciudad_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_experiencia_laboral');
    }
}
