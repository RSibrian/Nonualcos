<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasificacionesActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificaciones_activos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigoTipo')->unique();
            $table->string('nombreTipo');
            $table->Integer('idTipoLey')->unsigned();
            $table->foreign('idTipoLey')->references('id')->on('tipo_leyes');
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
        Schema::dropIfExists('clasificaciones_activos');
    }
}
