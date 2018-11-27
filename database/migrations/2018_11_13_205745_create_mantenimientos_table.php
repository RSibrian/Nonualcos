<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('mantenimientos', function (Blueprint $table) {
      $table->increments('id');
      $table->text('reparacionesSolicitadas');
      $table->integer('personalSolicitaMantenimiento')->unsigned();
      $table->date('fechaRecepcionTaller');
      $table->integer('empresaEncargada')->unsigned();
      $table->text('reparacionesRealizadas')->nullable();
      $table->date('fechaRetornoTaller')->nullable();
      $table->integer('personalRecibeMantenimiento')->unsigned()->nullable();
      $table->double('costoMantenimiento')->nullable();
      $table->integer('idActivo')->unsigned();
      $table->foreign('personalSolicitaMantenimiento')->references('id')->on('empleados');
      $table->foreign('empresaEncargada')->references('id')->on('proveedores');
      $table->foreign('personalRecibeMantenimiento')->references('id')->on('empleados');
      $table->foreign('idActivo')->references('id')->on('activos');
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
    Schema::dropIfExists('mantenimientos');
  }
}
