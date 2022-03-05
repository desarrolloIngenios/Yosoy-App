<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\Genero;


class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genero::truncate();

        $generos = [
            'M' => 'Masculino',
            'F' => 'Femenino',
            'O' => 'Otros',
        ];
        foreach ($generos as $nombre => $descripcion) {
            Genero::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
