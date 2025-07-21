<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Persona;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        
        $personas = Persona::inRandomOrder()->take(30)->get();

        if ($personas->isEmpty()) {
            echo "No hay personas para asignar clientes\n";
            return;
        }

        foreach ($personas as $persona) {
            Cliente::create([
                'persona_id' => $persona->id,
            ]);
        }

        echo "Clientes creados exitosamente\n";
    }
}
