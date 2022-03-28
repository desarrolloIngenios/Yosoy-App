<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferTipoContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_tipo_contrato', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->integer('tipo_contrato_id');
            //$table->timestamps();
            //$table->softDeletes();

            $table->index('offer_id');
            $table->index('tipo_contrato_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_tipo_contrato');
    }
}
