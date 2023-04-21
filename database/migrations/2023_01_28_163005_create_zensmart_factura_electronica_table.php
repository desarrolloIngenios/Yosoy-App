<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZensmartFacturaElectronicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zensmart_factura_electronica', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id');
            $table->integer('wompi_transacion_id');
            $table->longText('object');
            $table->integer('is_factura_enviada_correctamente')->default(0);
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
        Schema::dropIfExists('zensmart_factura_electronica');
    }
}
