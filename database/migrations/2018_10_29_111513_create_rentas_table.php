<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('tramo');

            $table->double('desde');
            $table->double('hasta');
            $table->double('sobreExceso');
            $table->double('cuotaFija');

            $table->double('semDesde');
            $table->double('semHasta');
            $table->double('semSobreExceso');
            $table->double('semCuotaFija');

            $table->double('anuDesde');
            $table->double('anuHasta');
            $table->double('anuSobreExceso');
            $table->double('anuCuotaFija');

            $table->double('porcentaje');
            $table->boolean('rentaEstado')->default(true);
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
        Schema::dropIfExists('rentas');
    }
}
