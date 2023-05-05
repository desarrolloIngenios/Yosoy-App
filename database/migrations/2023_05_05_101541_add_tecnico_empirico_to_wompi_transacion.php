<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTecnicoEmpiricoToWompiTransacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wompi_transacion', function (Blueprint $table) {
            $table->string('tipo_candidato_string')->default('empirico');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wompi_transacion', function (Blueprint $table) {
            $table->dropColumn('tipo_candidato_string');
        });
    }
}
