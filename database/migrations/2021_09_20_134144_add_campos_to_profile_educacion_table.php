<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToProfileEducacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_educacion', function (Blueprint $table) {
            $table->integer('institucion_educativa_id');
            $table->integer('ciudad_id');
            $table->integer('titulo_educativo_id');
            
            $table->dropColumn('pais_id');
            $table->dropColumn('titulo');
            $table->dropColumn('institucion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_educacion', function (Blueprint $table) {
            $table->dropColumn('institucion_educativa_id');
            $table->dropColumn('ciudad_id');
            $table->dropColumn('titulo_educativo_id');

            $table->integer('pais_id');
            $table->string('titulo')->default('');
            $table->string('institucion')->default('');

        });
    }
}
