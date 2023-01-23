<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZensmartRegimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zensmart_regime', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('nombre');
            $table->string('codigo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zensmart_regime');
    }
}

/*
 *

INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Entidades sin animo de lucro','tipo.tipo.regimen.esal','49');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Grande contribuyente autorretenedor','tipo.tipo.regimen.gca','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Grande contribuyente NO autorretenedor','tipo.tipo.regimen.gcna','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Instituciones del estado públicos y otros','tipo.tipo.regimen.iepo','49');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Persona Jurídica Responsable de IVA','tipo.tipo.regimen.pj','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Persona Jurídica Responsable de IVA Autorretenedor','tipo.tipo.regimen.pja','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Persona Natural - Responsable de IVA','tipo.tipo.regimen.pnrc','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Persona Natural No Responsable de IVA ','tipo.tipo.regimen.pnrs','49');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Tercero del Exterior','tipo.tipo.regimen.ext','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Persona Jurídica No Responsable  de IVA','tipo.tipo.regimen.pjnr','49');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Régimen Simple de Tributación - No Responsable de IVA','tipo.tipo.regimen.rstnr','49');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Régimen Simple de Tributación - Responsable de IVA','tipo.tipo.regimen.rst','48');
INSERT INTO zensmart_regime (descripcion,nombre,codigo) VALUES ('Tercero de Zona Franca','tipo.tipo.regimen.zf','48');

*
*/
