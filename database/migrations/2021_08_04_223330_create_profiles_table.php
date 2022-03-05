<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->integer('user_id');
            $table->integer('tipo_documento_id');
            $table->string('numero_documento');
            $table->string('numero_contacto_1');
            $table->string('numero_contacto_2')->nullable();
            $table->integer('genero_id');
            $table->string('email');
            $table->integer('pais_residencia_id');
            $table->integer('ciudad_residencia_id');
            $table->string('direccion_residencia');
            $table->timestamp('fecha_nacimiento');

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('tipo_documento_id');
            $table->index('ciudad_residencia_id');
            $table->index('genero_id');
            $table->index('pais_residencia_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
