<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacoraUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_usuarios', function (Blueprint $table) {
          $table->increments('id');
           $table->Integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users');
           $table->date('fecha');
           $table->date('horaInicio');
           $table->date('horaFinal');
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
        
            Schema::dropIfExists('bitacora_usuarios');

    }
}
