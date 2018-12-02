<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dip_dias');
            $table->integer('dip_dias_descontados')->default(0);
            $table->integer('dip_año');
            $table->integer('dip_mes');
            $table->Integer('permiso_id')->unsigned();
            $table->foreign('permiso_id')->references('id')->on('permisos');
            $table->date('dip_fecha');
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
        Schema::dropIfExists('dia_permisos');
    }
}
