<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoContratoFechaContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_contrato', function (Blueprint $table) {
            $table->integer('tipo_contrato_id')->nullable();
            $table->timestamp('fecha_contrato')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_contrato', function (Blueprint $table) {
            $table->dropColumn('tipo_contrato_id');
            $table->dropColumn('fecha_contrato');
        });
    }
}
