<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndemnizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indemnizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipoInd'); //despido, renuncia voluntaria
            $table->date('fechaFinalizacion');
            $table->double('montoInd');
            $table->string('motivoInd'); 
            $table->Integer('idEmpleado')->unsigned();
            $table->foreign('idEmpleado')->references('id')->on('empleados');
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
        Schema::dropIfExists('indemnizaciones');
    }
}
