<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZensmartTipoMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zensmart_tipo_moneda', function (Blueprint $table) {
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
        Schema::dropIfExists('zensmart_tipo_moneda');
    }
}

/*

INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Pesos Colombianos','currency-type.1','COP');
INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Dolares Americanos','currency-type.2','USD');
INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Reales Brasileño','currency-type.3','BLR');
INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Dolares Australiano','currency-type.4','AUD');
INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Dolares Canadiense','currency-type.5','CAD');
INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Euros','currency-type.6','EUR');
INSERT INTO zensmart_tipo_moneda (descripcion,nombre,codigo) VALUES ('Libras Esterlinas','currency-type.7','GBP');

*/