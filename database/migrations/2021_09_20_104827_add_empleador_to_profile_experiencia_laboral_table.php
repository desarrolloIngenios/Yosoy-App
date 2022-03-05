<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpleadorToProfileExperienciaLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_experiencia_laboral', function (Blueprint $table) {
            $table->string('empleador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_experiencia_laboral', function (Blueprint $table) {
            $table->dropColumn('empleador');
        });
    }
}
