<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('evento');
            $table->string('nombreSolicitante');
            $table->string('DUISolicitante');
            $table->string('telefonoSolicitante');
            $table->text('observacionPrestamo')->nullable();
            $table->text('DetallePrestamo')->nullable();
            $table->datetime('fechaEntregaPrestamo');
            $table->datetime('fechaDevolucionPrestamo');
            $table->datetime('fechaRegresoPrestamo')->nullable();
            $table->integer('estadoPrestamo')->default(1);
            $table->text('pdfPrestamo')->nullable();
            $table->integer('idInstitucion')->unsigned();
            $table->foreign('idInstitucion')->references('id')->on('instituciones');
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
        Schema::dropIfExists('prestamos');
    }
}
