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
      \App\ClasificacionesActivos::create([
          'codigoTipo' => '002',
          'NombreTipo' => 'Computadora',

      ]);
      \App\ClasificacionesActivos::create([
          'codigoTipo' => '003',
          'NombreTipo' => 'Impresora',

      ]);
      \App\ClasificacionesActivos::create([
          'codigoTipo' => '004',
          'NombreTipo' => 'Mesas',

      ]);
      \App\ClasificacionesActivos::create([
          'codigoTipo' => '005',
          'NombreTipo' => 'Fotocopiadora',

      ]);
      \App\ClasificacionesActivos::create([
          'codigoTipo' => '006',
          'NombreTipo' => 'Silla',

      ]);



    }
}
