<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeZensmartToTipoDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_documento', function (Blueprint $table) {
            $table->string('zensmart_nombre')->default("");
            $table->string('zensmart_codigo')->default("");
            $table->string('zensmart_descripcion')->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_documento', function (Blueprint $table) {
            $table->dropColumn('zensmart_nombre');
            $table->dropColumn('zensmart_codigo');
            $table->dropColumn('zensmart_descripcion');
            
        });
    }
}
