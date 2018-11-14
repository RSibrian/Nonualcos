<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAportacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aportaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombreAportacion');
            $table->text('descripcionAportacion')->nullable();
            $table->Integer('tipoAportacion');
            $table->double('desEmpleadoAportacion');
            $table->double('desPatronAportacion');
            $table->boolean('estadoAportacion')->default(true);
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
        Schema::dropIfExists('aportaciones');
    }
}
