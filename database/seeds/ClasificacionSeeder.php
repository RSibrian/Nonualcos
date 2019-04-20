<?php

use Illuminate\Database\Seeder;

class ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\ClasificacionesActivos::create([
          'codigoTipo' => '001',
          'NombreTipo' => 'Transporte',

      ]);



    }
}
