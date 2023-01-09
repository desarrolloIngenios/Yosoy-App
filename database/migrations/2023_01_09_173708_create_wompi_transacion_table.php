<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWompiTransacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wompi_transacion', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('referencia');
            $table->string('transaccion_wompi_id')->nullable();
            $table->string('estado_wompi')->nullable();
            $table->string('valor_wompi')->nullable();
            $table->string('fecha_wompi')->nullable();
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
        Schema::dropIfExists('wompi_transacion');
    }
}
