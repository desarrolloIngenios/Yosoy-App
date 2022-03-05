<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PaisSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(TipoTrabajoSeeder::class);
        $this->call(NivelExperienciaSeeder::class);
        $this->call(TiempoExperienciaSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(TipoContratoSeeder::class);
        $this->call(EmpleadorSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(NivelEducativoSeeder::class);
        $this->call(TituloEducativoSeeder::class);
        $this->call(InstitucionEducativaSeeder::class);
    
        Model::reguard();
    }
}
