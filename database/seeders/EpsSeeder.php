<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eps = [
            ['pais' => 'Colombia', 'nombre' => 'Coosalud EPS-S'],
            ['pais' => 'Colombia', 'nombre' => 'Nueva EPS'],
            ['pais' => 'Colombia', 'nombre' => 'Mutual Ser EPS'],
            ['pais' => 'Colombia', 'nombre' => 'Aliansalud EPS'],
            ['pais' => 'Colombia', 'nombre' => 'Salud Total EPS S.A.'],
            ['pais' => 'Colombia', 'nombre' => 'EPS Sanitas'],
            ['pais' => 'Colombia', 'nombre' => 'EPS SURA'],
            ['pais' => 'Colombia', 'nombre' => 'Famisanar'],
            ['pais' => 'Colombia', 'nombre' => 'Servicio Occidental de Salud EPS S.O.S'],
            ['pais' => 'Colombia', 'nombre' => 'Salud Mía EPS'],
            ['pais' => 'Colombia', 'nombre' => 'EPS Comfenalco Valle'],
            ['pais' => 'Colombia', 'nombre' => 'Compensar EPS'],
            ['pais' => 'Colombia', 'nombre' => 'EPM – Empresas Públicas de Medellín'],
            ['pais' => 'Colombia', 'nombre' => 'Fondo de Pasivo Social de Ferrocarriles Nacionales de Colombia'],
            ['pais' => 'Colombia', 'nombre' => 'Cajacopi Atlántico'],
            ['pais' => 'Colombia', 'nombre' => 'Comfachocó'],
            ['pais' => 'Colombia', 'nombre' => 'Comfaoriente'],
            ['pais' => 'Colombia', 'nombre' => 'EPS Familiar de Colombia'],
            ['pais' => 'Colombia', 'nombre' => 'Asmet Salud'],
            ['pais' => 'Colombia', 'nombre' => 'Emssanar'],
            ['pais' => 'Colombia', 'nombre' => 'Capital Salud EPS-S'],
            ['pais' => 'Colombia', 'nombre' => 'Savia Salud EPS'],
            ['pais' => 'Colombia', 'nombre' => 'Dusakawi EPSI'],
            ['pais' => 'Colombia', 'nombre' => 'Asociación Indígena del Cauca EPSI'],
            ['pais' => 'Colombia', 'nombre' => 'Anas Wayuu EPSI'],
            ['pais' => 'Colombia', 'nombre' => 'Mallamas EPSI'],
            ['pais' => 'Colombia', 'nombre' => 'Pijaos Salud EPSI'],
            ['pais' => 'Colombia', 'nombre' => 'Salud Bolívar EPS SAS'],
            ['pais' => 'Ecuador', 'nombre' => 'Instituto Ecuatoriano de Seguridad Social (IESS)'],
            ['pais' => 'Ecuador', 'nombre' => 'Ministerio de Salud Pública (MSP)'],
        ];
        DB::table('eps')->insert($eps);
    }
}
