<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::truncate();

        $data = [
            "Manufactura" => "Manufactura",
            "Hoteles y turismo" => "Hoteles y turismo",
            "Farmacéutico" => "Farmacéutico",
            "Quimicos" => "Quimicos",
            "Plasticos" => "Plasticos",
            "Inmobiliarios - Cuidado del hogar" => "Inmobiliarios - Cuidado del hogar",
            "Alimentos" => "Alimentos",
            "Confección" => "Confección",
            "Gastrobares" => "Gastrobares",
            "Otro" => "Otro",
        ];
        foreach ($data as $nombre => $descripcion) {
            Sector::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
