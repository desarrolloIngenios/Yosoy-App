<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::truncate();

        $faker = \Faker\Factory::create('es_ES');
        $departamentos = ["Bogotá D.C.", "Cundinamarca", "Amazonas", "Antioquia", "Arauca", "Archipiélago de San Andrés, Providencia y Santa Catalina", "Atlántico", "Bolívar", "Boyacá", "Caldas", "Caquetá", "Casanare", "Cauca", "Cesar", "Chocó", "Córdoba", "Guainía", "Guaviare", "Huila", "La Guajira", "Magdalena", "Meta", "Nariño", "Norte de Santander", "Putumayo", "Quindío", "Risaralda", "Santander", "Sucre", "Tolima", "Valle del Cauca", "Vaupés", "Vichada"];
 
        foreach ($departamentos as $departamento) {
            Departamento::create([
                'nombre' => $departamento,
                'descripcion' => $departamento,
                'pais_id' => 1,
            ]);
        }
    }
}


