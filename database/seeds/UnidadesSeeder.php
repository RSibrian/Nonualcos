<?php

use Illuminate\Database\Seeder;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Unidades::create([
            'codigoUnidad' => '001',
            'nombreUnidad' => 'Informatica',
        ]);
        \App\Unidades::create([
            'codigoUnidad' => '002',
            'nombreUnidad' => 'Administracion Financiera',
        ]);
    }
}
