<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tabla salidas
        Schema::create('salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaSalida');
            $table->string('destinoTrasladarse');
            $table->time('hsalida');
            $table->double('ksalida');
            $table->time('hllegada');
            $table->double('kllegada');
            $table->string('crecibidogls');
            $table->string('mision')->nullable();

            $table->integer('idVehiculo')->unsigned();
            $table->foreign('idVehiculo')->references('id')->on('vehiculos');

            $table->integer('idEmpleado')->unsigned();//  asignado para campo solicitante
            $table->foreign('idEmpleado')->references('id')->on('empleados');

            //$table->rememberToken();
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
        //
        Schema::dropIfExists('salidas');
    }
}
