<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos_unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->Date('fechaInicioUni')->nullable();
            $table->Date('fechaFinalUni')->nullable();
            $table->boolean('estadoUni')->default(1);
            $table->string('observacionUni')->nullable();
            $table->Integer('idAutoriza');
            $table->Integer('idActivo')->unsigned();
            $table->foreign('idActivo')->references('id')->on('activos');
            $table->Integer('idUnidad')->unsigned();
            $table->foreign('idUnidad')->references('id')->on('unidades');
            $table->Integer('idEmpleado')->unsigned()->nullable();
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
        Schema::dropIfExists('activos_unidades');
    }
}
