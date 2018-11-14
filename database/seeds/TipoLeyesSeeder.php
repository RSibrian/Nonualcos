<?php

use Illuminate\Database\Seeder;

class TipoLeyesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\TipoLeyes::create([
          'nombreLey' => 'Edificaciones',
          'valorPorcentaje' => 5,
      ]);

      \App\TipoLeyes::create([
          'nombreLey' => 'Maquinaria',
          'valorPorcentaje' => 20,
      ]);
      \App\TipoLeyes::create([
          'nombreLey' => 'Vehículo',
          'valorPorcentaje' => 25,
      ]);
      \App\TipoLeyes::create([
          'nombreLey' => 'Otros Bienes',
          'valorPorcentaje' => 50,
      ]);
    }
}
