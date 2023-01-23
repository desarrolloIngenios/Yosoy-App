<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposZendsmartToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->integer('digito_verificacion')->nullable();
            $table->integer('tipo_documento_id')->nullable();
            $table->integer('regimen_id')->nullable();
            $table->integer('actividad_economica_id')->nullable();
            $table->string('codigo_postal')->default("00000");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('digito_verificacion');
            $table->dropColumn('tipo_documento_id');
            $table->dropColumn('regimen_id');
            $table->dropColumn('actividad_economica_id');
            $table->dropColumn('codigo_postal');
        });
    }
}
