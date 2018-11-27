<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('generoEmpleado');
            $table->string('estadoCivilEmpleado');
            $table->string('nombresEmpleado');
            $table->string('apellidosEmpleado');
            $table->date('fechaNacimientoEmpleado');
            $table->date('fechaIngreso');
            // $table->text('telefonoEmpleado')->nullable();
            $table->string('DUIEmpleado')->unique();
            $table->string('NITEmpleado')->unique();
            $table->text('dirreccionEmpleado');
            $table->text('observacionEmpleado')->nullable();
            $table->text('imagenEmpleado');
            $table->text('sistemaContratacion');
            $table->double('salarioBruto')->default(0);
            $table->Integer('estadoEmpleado')->default(1);
            $table->Integer('idCargo')->unsigned();
            $table->foreign('idCargo')->references('id')->on('cargos');
            $table->Integer('idSeguro')->unsigned();
            $table->foreign('idSeguro')->references('id')->on('aportaciones');
            $table->string('numeroSeguro')->nullable();
            $table->Integer('idAFP')->unsigned();
            $table->foreign('idAFP')->references('id')->on('aportaciones');
            $table->string('numeroAFP')->nullable();
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
        Schema::dropIfExists('empleados');
    }
}
