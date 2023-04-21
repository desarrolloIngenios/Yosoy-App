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


// UPDATE tipo_documento SET tipo_documento.zensmart_codigo = '13', tipo_documento.zensmart_descripcion = 'CC', tipo_documento.zensmart_nombre = 'tipo.doc.cc' WHERE id = 1;
// UPDATE tipo_documento SET tipo_documento.zensmart_codigo = '41', tipo_documento.zensmart_descripcion = 'Pasaporte', tipo_documento.zensmart_nombre = 'tipo.documento.pasaporte' WHERE id = 4;
// UPDATE tipo_documento SET tipo_documento.zensmart_codigo = '12', tipo_documento.zensmart_descripcion = 'Tarjeta de identidad', tipo_documento.zensmart_nombre = 'tipo.documento.tarjeta.identidad' WHERE id = 3;
// UPDATE tipo_documento SET tipo_documento.zensmart_codigo = '22', tipo_documento.zensmart_descripcion = 'Cédula de extranjería', tipo_documento.zensmart_nombre = 'tipo.documento.ce' WHERE id = 2;

// INSERT INTO `yosoy`.`tipo_documento` (`nombre`, `descripcion`, `created_at`, `updated_at`, `zensmart_nombre`, `zensmart_codigo`, `zensmart_descripcion`) VALUES ('NIT', 'NIT', '2021-09-20 13:36:14', '2021-09-20 13:36:14', 'tipo.doc.nit', '31', 'NIT');
// INSERT INTO `yosoy`.`tipo_documento` (`nombre`, `descripcion`, `created_at`, `updated_at`, `zensmart_nombre`, `zensmart_codigo`, `zensmart_descripcion`) VALUES ('Otro', 'Otro', '2021-09-20 13:36:14', '2021-09-20 13:36:14', 'tipo.doc.otro', '50', 'Otro');
// INSERT INTO `yosoy`.`tipo_documento` (`nombre`, `descripcion`, `created_at`, `updated_at`, `zensmart_nombre`, `zensmart_codigo`, `zensmart_descripcion`) VALUES ('Tarjeta de extranjería', 'Tarjeta de extranjería', '2021-09-20 13:36:14', '2021-09-20 13:36:14', 'tipo.documento.tarjeta.de extranjería', '21', 'Tarjeta de extranjería');
