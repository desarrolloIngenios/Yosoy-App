<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->integer('tipo_documento_id')->nullable()->change();
            $table->string('numero_documento')->nullable()->change();
            $table->string('numero_contacto_1')->nullable()->change();
            $table->integer('genero_id')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->integer('pais_residencia_id')->nullable()->change();
            $table->integer('ciudad_residencia_id')->nullable()->change();
            $table->string('direccion_residencia')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile', function (Blueprint $table) {
            //
        });
    }
}
