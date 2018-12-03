<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('idEmpleado')->unsigned();
            $table->foreign('idEmpleado')->references('id')->on('empleados');
            $table->date('fechaPermisoInicio');
            $table->date('fechaPermisoFinal')->nullable();
            $table->Integer('tipoPermiso');
            $table->text('casoPermiso')->nullable();
            $table->text('motivoPermiso')->nullable();
            $table->boolean('perm_opcion');
            $table->text('permisoPdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
