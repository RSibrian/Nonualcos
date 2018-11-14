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
            $table->increments('idSalida');
            $table->date('fechaSalida')->required();
            $table->string('destinoTrasladarse')->required();
            $table->string('mision')->required();
            $table->tinyInteger('estadoSalida')->default(1);
            $table->date('fechaLiquidacion')->nullable();
            $table->string('numeroFacturaLiquidacion')->nullable();
            $table->double('montoFacturaLiquidacion')->nullable();

            $table->integer('idVehiculo')->nullable()->unsigned();
            $table->foreign('idVehiculo')->references('id')->on('vehiculos');

            $table->integer('idEmpleado')->unsigned();
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
