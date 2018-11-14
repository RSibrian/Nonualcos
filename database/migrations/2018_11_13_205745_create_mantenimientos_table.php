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
            $table->date('fechaRecepcionTaller');
            $table->string('reparacionesRealizadas')->nullable();
            $table->string('empresaEncargada');
            $table->date('fechaEntregaMantenimiento')->nullable();
            $table->double('costoMantenimiento')->nullable();
            $table->string('personalRecibeMantenimiento');
            $table->integer('idActivo')->unsigned();
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
