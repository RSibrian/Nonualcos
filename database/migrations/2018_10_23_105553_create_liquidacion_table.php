<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tabla liquidaciones
        Schema::create('liquidaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaLiquidacion')->required();
            $table->string('numeroFacturaLiquidacion')->required();
            $table->double('montoFacturaLiquidacion')->required();

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
        Schema::dropIfExists('liquidaciones');
    }
}
