<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('idEmpleado')->unsigned();
            $table->foreign('idEmpleado')->references('id')->on('empleados');
            $table->Integer('banco_id')->unsigned();
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->double('pago');
            $table->text('numeroCuenta');
            $table->text('observacionDescuento')->nullable();
            $table->text('imagenInicio');
            $table->integer('aniosDescuento')->nullable();
            $table->integer('mesesDescuento')->nullable();
            $table->text('imagenFinal')->nullable();
            $table->boolean('estadoDescuento')->default(true);
            $table->integer('tipoDescuento');
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
        Schema::dropIfExists('descuentos');
    }
}
