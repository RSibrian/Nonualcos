<?php

use Illuminate\Database\Seeder;

class RentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    /*    \App\Renta::create([
            'tramo' => 1,
            'desde' => 0.01,
            'hasta' => 472.00,
            'porcentaje' => 0,
            'sobreExceso' => 0,
            'cuotaFija' => 0,
        ]);
        \App\Renta::create([
            'tramo' => 2,
            'desde' => 472.01,
            'hasta' => 895.24,
            'porcentaje' => 10,
            'sobreExceso' => 472.00,
            'cuotaFija' => 17.67,
        ]);

        \App\Renta::create([
            'tramo' => 3,
            'desde' => 895.25,
            'hasta' => 2038.10,
            'porcentaje' => 20,
            'sobreExceso' => 895.24,
            'cuotaFija' => 60.00,
        ]);
        \App\Renta::create([
            'tramo' => 4,
            'desde' => 2038.11,
            'hasta' => 100000,
            'porcentaje' => 30,
            'sobreExceso' => 2038.10,
            'cuotaFija' => 288.57,
        ]);*/

        \App\Renta::create([
            'tramo' => 1,
            //mensual
            'desde' => 0.01,
            'hasta' => 472.00,
            'sobreExceso' => 0,
            'cuotaFija' => 0,
            //semestral
            'semDesde' => 0.01,
            'semhasta' => 2832.00,
            'semSobreExceso' => 0,
            'semCuotaFija' => 0,
            //anual
            'anuDesde' => 0.01,
            'anuHasta' => 5664.00,
            'anuSobreExceso' => 0,
            'anuCuotaFija' => 0,

            'porcentaje' => 0,


        ]);

        \App\Renta::create([
            'tramo' => 2,
            //mensual
            'desde' => 472.01,
            'hasta' => 895.24,
            'sobreExceso' => 472.00,
            'cuotaFija' => 17.67,
            //semestral
            'semDesde' => 2832.01,
            'semHasta' => 5371.44,
            'semSobreExceso' => 2832.00,
            'semCuotaFija' => 106.20,
            //anual
            'anuDesde' => 5664.01,
            'anuHasta' => 10742.86,
            'anuSobreExceso' => 5664.00,
            'anuCuotaFija' => 212.12,

            'porcentaje' => 10,
        ]);

        \App\Renta::create([
            'tramo' => 3,
            //mensual
            'desde' => 895.25,
            'hasta' => 2038.10,
            'sobreExceso' => 895.24,
            'cuotaFija' => 60.00,
            //semestral
            'semDesde' => 5371.45,
            'semHasta' => 12228.60,
            'semSobreExceso' => 5371.44,
            'semCuotaFija' => 360,
            //anual
            'anuDesde' => 10742.87,
            'anuHasta' => 24457.14,
            'anuSobreExceso' => 10742.86,
            'anuCuotaFija' => 720.00,

            'porcentaje' => 20,
        ]);
        \App\Renta::create([
            'tramo' => 4,
            //mensual
            'desde' => 2038.11,
            'hasta' => 1000000,
            'sobreExceso' => 2038.10,
            'cuotaFija' => 288.57,
            //semestral
            'semDesde' => 12228.61,
            'semHasta' => 1000000,
            'semSobreExceso' => 12228.60,
            'semCuotaFija' => 1731.42,
            //anual
            'anuDesde' => 24457.15,
            'anuHasta' => 1000000,
            'anuSobreExceso' => 24457.14,
            'anuCuotaFija' => 3462.86,
            'porcentaje' => 30,
        ]);
    }
}
