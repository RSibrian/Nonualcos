<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigoInventario')->nullable();
            $table->string('nombreActivo');
            $table->string('numeroFactura')->nullable();
            $table->double('precio');
            $table->string('marca')->nullable();
            $table->string('serie')->nullable();
            $table->string('modelo')->nullable();
            $table->string('color')->nullable();
            $table->text('ObservacionActivo')->nullable();
            $table->Integer('tipoActivo');//SI ES VEHICULO O NO
            $table->boolean('tipoAdquisicion')->default(1);//1-compra 0-donacion
            $table->date('fechaAdquisicion');
            $table->Integer('estadoActivo')->default(1); // 1-activo 2-da;ado 3-prestado 4-dadodebaja
            $table->text('justificacionActivo')->nullable();
            $table->Date('fechaBajaActivo')->nullable();
            $table->boolean('estadoUsado')->nullable();
            $table->Integer('aniosUso')->nullable();
            $table->Integer('aniosVida')->nullable();
            $table->Double('valorResidual')->nullable();
            $table->Integer('idProveedor')->unsigned()->nullable();
            $table->foreign('idProveedor')->references('id')->on('proveedores');
            $table->Integer('idClasificacionActivo')->unsigned();
            $table->foreign('idClasificacionActivo')->references('id')->on('clasificaciones_activos');
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
        Schema::dropIfExists('activos');
    }
}
