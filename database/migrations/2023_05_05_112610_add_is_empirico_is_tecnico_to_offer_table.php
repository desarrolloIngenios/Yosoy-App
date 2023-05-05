<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEmpiricoIsTecnicoToOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer', function (Blueprint $table) {
            $table->boolean('is_empirico')->default(false);
            $table->boolean('is_tecnico')->default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer', function (Blueprint $table) {
            $table->dropColumn('is_empirico');
            $table->dropColumn('is_tecnico');
        });
    }
}
