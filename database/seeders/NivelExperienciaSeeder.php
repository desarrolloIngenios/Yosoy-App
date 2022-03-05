<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\NivelExperiencia;

class NivelExperienciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelExperiencia::truncate();

        $data = [
            'Estudiante' => 'Estudiante',
            'Practicante' => 'Practicante',
            'Principiante' => 'Principiante',
            'Intermedio' => 'Intermedio',
            'Avanzado' => 'Avanzado',
        ];
        foreach ($data as $nombre => $descripcion) {
            NivelExperiencia::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
