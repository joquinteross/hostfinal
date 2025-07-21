<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CompraProductoSeeder extends Seeder
{
    public function run(): void
    {
        $compras = Compra::all();
        $productos = Producto::all();

        if ($compras->isEmpty() || $productos->isEmpty()) {
            echo "No hay compras o productos para poblar compra_producto\n";
            return;
        }

        foreach ($compras as $compra) {
            // Seleccionar entre 1 y 4 productos aleatorios para cada compra
            $items = $productos->random(rand(1, 4));

            foreach ($items as $producto) {
                $cantidad = rand(1, 10);
                $precio = $producto->precio ?? rand(1000, 50000);
                $precioVenta = $precio + rand(10, 50) / 100 * $precio;
                $precioVenta = round($precioVenta, 2);

                DB::table('compra_producto')->insert([
                    'compra_id' => $compra->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_compra' => $precio,
                    'precio_venta' => $precioVenta,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "Registros insertados en compra_producto correctamente\n";
    }
}
