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
            $table->date('fechaCreacion')->required();
            $table->string('numeroVale')->unique()->required();
            $table->double('costoUnitarioVale')->unsigned();
            $table->string('tipoCombustible')->required();
            $table->double('galones')->required();
            $table->string('gasolinera')->required();
            $table->integer('empleadoAutorizaVal')->required();
            $table->integer('empleadoRecibeVal')->required();
            $table->tinyInteger('estadoEntregadoVal')->required();
            $table->tinyInteger('estadoRecibidoVal')->default(0);
            $table->tinyInteger('estadoLiquidacionVal')->default(0);

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
