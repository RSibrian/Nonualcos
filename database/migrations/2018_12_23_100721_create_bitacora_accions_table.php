<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacoraAccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_accions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accion');
            //$table->string('registroAntes')->nullable();
            //$table->string('registroDespues');
            $table->text('registroAntes')->nullable();
            $table->text('registroDespues');
            $table->Integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
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
        Schema::dropIfExists('bitacora_accions');
    }
}
