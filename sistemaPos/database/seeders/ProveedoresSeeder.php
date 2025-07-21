<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedore;
use App\Models\Persona;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {
        // Filtramos personas de tipo "Proveedor"
        $personasProveedores = Persona::where('tipo_persona', 'Proveedor')->take(10)->get();

        foreach ($personasProveedores as $persona) {
            Proveedore::create([
                'persona_id' => $persona->id,
            ]);
        }
    }
}
