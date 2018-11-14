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
        \App\Renta::create([
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
        ]);
    }
}
