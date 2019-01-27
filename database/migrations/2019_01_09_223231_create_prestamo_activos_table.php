<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamoActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos_prestamo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activos_id')->unsigned();
            $table->foreign('activos_id')->references('id')->on('activos');
            $table->integer('prestamo_id')->unsigned();
            $table->foreign('prestamo_id')->references('id')->on('prestamos');
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
        Schema::dropIfExists('activos_prestamo');
    }
}
