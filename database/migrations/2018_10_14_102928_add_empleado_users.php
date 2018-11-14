<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmpleadoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
            $table->Integer('idEmpleado')->nullable()->unsigned();
            $table->foreign('idEmpleado')->references('id')->on('empleados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function ( $table) {
            $table->dropForeign('users_idEmpleado_foreign');
            $table->dropColumn('idEmpleado');

        });
    }
}
