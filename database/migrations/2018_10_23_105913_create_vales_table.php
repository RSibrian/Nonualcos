<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tabla vales
        Schema::create('vales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaCreacion');
            $table->string('numeroVale');
            $table->double('costoUnitarioVale')->default(0)->nullable();
            $table->tinyInteger('tipoCombustible');
            $table->string('gasolinera');
            $table->double('galones')->default(0)->nullable();
            $table->double('costoGalones')->default(0)->nullable();
            $table->tinyInteger('aceite')->unsigned();
            $table->double('costoAceite')->default(0)->nullable();
            $table->tinyInteger('grasa')->unsigned();
            $table->double('costoGrasa')->default(0)->nullable();
            $table->string('otro')->nullable();
            $table->double('costoOtro')->default(0)->nullable();
            $table->integer('empleadoAutorizaVal');
            $table->integer('empleadoRecibeVal');
            $table->tinyInteger('estadoEntregadoVal');
            $table->tinyInteger('estadoRecibidoVal')->default(0);
            $table->tinyInteger('estadoLiquidacionVal')->default(0)->nullable();

            $table->integer('idLiquidacion')->nullable()->unsigned();
            $table->foreign('idLiquidacion')->references('id')->on('liquidaciones');

            $table->integer('idSalida')->unsigned();
            $table->foreign('idSalida')->references('id')->on('salidas');

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
        Schema::dropIfExists('vales');
    }
}
