<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaracteristicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          for ($i = 1; $i <= 30; $i++) {
            DB::table('caracteristicas')->insert([
                'nombre' => 'Característica ' . $i,
                'descripcion' => 'Descripción de la característica ' . $i,
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
