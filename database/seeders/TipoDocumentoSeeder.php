<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\TipoDocumento;


class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::truncate();

        $documentos = [
            'CC' => 'Cédula de Ciudadanía',
            'CE' => 'Cédula de Extranjería',
            'TI' => 'Tarjeta de Identidad',
            'PA' => 'Pasaporte',
        ];
        foreach ($documentos as $nombre => $descripcion) {
            TipoDocumento::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
