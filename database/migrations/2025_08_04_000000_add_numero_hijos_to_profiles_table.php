<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroHijosToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->string('numero_hijos')->nullable()->after('billetera');
        });
    }

    public function down()
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->dropColumn('numero_hijos');
        });
    }
}
