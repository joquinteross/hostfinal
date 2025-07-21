<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comprobante;
use App\Models\User;
use App\Models\Proveedore;

class ComprasSeeder extends Seeder
{
    public function run(): void
    {
        $comprobantes = Comprobante::all();
        $usuarios = User::all();
        $proveedores = Proveedore::all(); // Revisa si tu modelo es singular (Proveedor) o plural (Proveedore)

        if ($comprobantes->isEmpty() || $usuarios->isEmpty() || $proveedores->isEmpty()) return;

        for ($i = 0; $i < 30; $i++) {
            DB::table('compras')->insert([
                'fecha_hora' => now()->subDays(rand(1, 100)),
                'impuesto' => rand(500, 2000),
                'numero_comprobante' => 'COMP-' . strtoupper(uniqid()),
                'total' => rand(10000, 100000),
                'estado' => 1,
                'comprobante_id' => $comprobantes->random()->id,
                'proveedore_id' => $proveedores->random()->id,
                'user_id' => $usuarios->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}