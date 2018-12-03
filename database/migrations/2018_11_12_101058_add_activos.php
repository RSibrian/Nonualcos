<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('activos', function($table) {
          // $table->boolean('estadoUsado')->nullable();
          // $table->Integer('aniosUso')->nullable();
          // $table->Integer('aniosVida')->nullable();
          // $table->Double('valorResidual')->nullable();

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
    }
}
