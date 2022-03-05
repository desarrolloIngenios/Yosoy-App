<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Base\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Pais::truncate();

        $faker = \Faker\Factory::create('es_ES');
        $paises = ["Colombia","Argentina","Bolivia","Brasil","Chile","Costa Rica","Cuba","Ecuador","El Salvador","Guatemala","Haití","Honduras","México","Nicaragua","Panamá","Paraguay","Perú","República Dominicana","Uruguay","Venezuela"];
 
        foreach ($paises as $pais) {
            Pais::create([
                'nombre' => $pais,
                'descripcion' => $pais,
            ]);
        }
        
    }
}
