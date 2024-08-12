<?php

namespace Database\Seeders;

use App\Models\PoliticaActual;
use Illuminate\Database\Seeder;

class PoliticaActualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        PoliticaActual::truncate();

        $politicas = [
            ['id' => 1, 'version' => '1.0'],
        ];

        foreach ($politicas as $politica) {
            PoliticaActual::create($politica);
        }
    }
}
