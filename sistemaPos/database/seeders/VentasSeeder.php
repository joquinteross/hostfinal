<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Comprobante;

class VentasSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        $comprobantes = Comprobante::all();

        if ($clientes->isEmpty() || $usuarios->isEmpty() || $comprobantes->isEmpty()) return;

        for ($i = 0; $i < 30; $i++) {
            DB::table('ventas')->insert([
                'fecha_hora' => now()->subDays(rand(1, 100)),
                'impuesto' => rand(500, 2000),
                'numero_comprobante' => 'VENT-' . strtoupper(uniqid()),
                'total' => rand(10000, 100000),
                'estado' => 1,
                'cliente_id' => $clientes->random()->id,
                'user_id' => $usuarios->random()->id,
                'comprobante_id' => $comprobantes->random()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}