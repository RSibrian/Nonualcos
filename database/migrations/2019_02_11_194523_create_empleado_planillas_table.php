<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoPlanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_planillas', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('idEmpleado')->unsigned();
            $table->foreign('idEmpleado')->references('id')->on('empleados');
            $table->Integer('idPlanilla')->unsigned();
            $table->foreign('idPlanilla')->references('id')->on('planillas');
            $table->string('unidad');
            $table->string('cargo');
            $table->double('salario');
            $table->Integer('dias');
            $table->double('salarioDevengado');
            $table->double('ISSS');
            $table->Integer('idAFP')->unsigned();
            $table->foreign('idAFP')->references('id')->on('aportaciones');
            $table->double('AFP');
            $table->double('renta');
            $table->double('llegadasTarde');
            $table->double('totalDescuentos');
            $table->double('sueldoNeto');
            $table->double('ISSSPatronal');
            $table->double('AFPPatronal');
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
        Schema::dropIfExists('empleado_planillas');
    }
}
