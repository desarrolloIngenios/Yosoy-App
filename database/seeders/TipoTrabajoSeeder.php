<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\TipoTrabajo;


class TipoTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoTrabajo::truncate();

        $tipo_trabajos = [
            'Alternancia' => 'Alternancia',
            'Home office' => 'Home office',
            'Presencial' => 'Presencial',
        ];
        foreach ($tipo_trabajos as $nombre => $descripcion) {
            TipoTrabajo::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
