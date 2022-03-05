<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\TiempoExperiencia;


class TiempoExperienciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TiempoExperiencia::truncate();

        $data = [
            'Menos de 1 año' => 'Menos de 1 año',
            '1 año' => '1 año',
            '2 años' => '2 años',
            '3 años' => '3 años',
            '4 años' => '4 años',
            '5 años o más' => '5 años o más',
        ];
        foreach ($data as $nombre => $descripcion) {
            TiempoExperiencia::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
