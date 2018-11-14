<?php

use Illuminate\Database\Seeder;

class AportacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Aportaciones::create([
            'nombreAportacion' => 'Sin Aportaciones',
            'descripcionAportacion' => 'Para Jubilados ',
            'tipoAportacion' => 3,
            'desEmpleadoAportacion' => 0,
            'desPatronAportacion' => 0,
        ]);
        \App\Aportaciones::create([
            'nombreAportacion' => 'ISSS',
            'descripcionAportacion' => 'Instituto Salvadoreño del Seguro Social ',
            'tipoAportacion' => 1,
            'desEmpleadoAportacion' => 3,
            'desPatronAportacion' => 7.50,
        ]);
        \App\Aportaciones::create([
            'nombreAportacion' => 'AFP CRECER',
            'descripcionAportacion' => 'Administrador de Fondos de Pensiones CRECER',
            'tipoAportacion' => 2,
            'desEmpleadoAportacion' => 7.25,
            'desPatronAportacion' => 7.75,
        ]);
        \App\Aportaciones::create([
            'nombreAportacion' => 'AFP Confía',
            'descripcionAportacion' => 'Las Administradoras de Fondos de Pensiones Confía',
            'tipoAportacion' => 2,
            'desEmpleadoAportacion' => 7.25,
            'desPatronAportacion' => 7.75,
        ]);
    }
}
