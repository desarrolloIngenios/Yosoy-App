<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEpsFieldsToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->string('eps')->nullable();
            $table->string('nombre_eps')->nullable();
        });
    }

    public function down()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->dropColumn('eps');
            $table->dropColumn('nombre_eps');
        });
    }
}
