<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\NivelEducativo;

class NivelEducativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelEducativo::truncate();

        $data = [
            'Empirico' => 'Empirico',
            'Básica Primaria' => 'Básica Primaria',
            'Bachiller' => 'Bachiller',
            'Técnico' => 'Técnico',
            'Tecnólogo' => 'Tecnólogo',
            'Profesional' => 'Profesional',
        ];
        foreach ($data as $nombre => $descripcion) {
            NivelEducativo::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
