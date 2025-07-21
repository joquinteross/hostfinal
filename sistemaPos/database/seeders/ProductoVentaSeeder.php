<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class ProductoVentaSeeder extends Seeder
{
    public function run(): void
    {
        $productos = Producto::all();
        $ventas = Venta::all();

        if ($productos->isEmpty() || $ventas->isEmpty()) {
            echo "No hay productos o ventas para generar producto_venta\n";
            return;
        }

        foreach ($ventas as $venta) {
            // Para cada venta, asigna 1-3 productos
            $items = $productos->random(rand(1, 3));

            foreach ($items as $producto) {
                $cantidad = rand(1, 5);
                $precioVenta = $producto->precio ?? rand(10000, 50000);
                $descuento = rand(0, 20); // porcentaje

                DB::table('producto_venta')->insert([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_venta' => $precioVenta,
                    'descuento' => $descuento,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "Registros insertados en producto_venta correctamente\n";
    }
}

