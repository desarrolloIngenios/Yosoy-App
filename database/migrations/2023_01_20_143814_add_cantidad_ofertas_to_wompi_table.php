<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCantidadOfertasToWompiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wompi_transacion', function (Blueprint $table) {
            $table->integer('cantidad_ofertas')->default(1);
            
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
            $table->dropColumn('cantidad_ofertas');
        });
    }
}
