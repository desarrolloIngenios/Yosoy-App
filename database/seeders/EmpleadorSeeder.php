<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\Empleador;

class EmpleadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleador::truncate();

        $data = [
            'Empleador 1' => 'Empleador 1',
            'Empleador 2' => 'Empleador 2',
            'Empleador 3' => 'Empleador 3',
            'Empleador 4' => 'Empleador 4',
            'Empleador 5' => 'Empleador 5',
        ];
        foreach ($data as $nombre => $descripcion) {
            Empleador::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
