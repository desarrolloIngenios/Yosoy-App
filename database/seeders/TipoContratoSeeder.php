<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\TipoContrato;


class TipoContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoContrato::truncate();

        $data = [
            'Por horas' => 'Por horas',
            'Medio tiempo' => 'Medio tiempo',
            'Tiempo completo' => 'Tiempo completo',
            'Práctica' => 'Práctica',
        ];
        foreach ($data as $nombre => $descripcion) {
            TipoContrato::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
