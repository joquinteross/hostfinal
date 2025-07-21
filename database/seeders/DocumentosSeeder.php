<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documento;

class DocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::insert([
            ['tipo_documento' => 'Cédula'],
            ['tipo_documento' => 'NIT'],
            ['tipo_documento' => 'Pasaporte'],
            ['tipo_documento' => 'RUT'],
            ['tipo_documento' => 'Cédula de extranjería'],
            ['tipo_documento' => 'DNI'],
            ['tipo_documento' => 'Licencia'],
            ['tipo_documento' => 'Carné'],
            ['tipo_documento' => 'Otro'],
            ['tipo_documento' => 'Identidad temporal'],
        ]);
    }
}
