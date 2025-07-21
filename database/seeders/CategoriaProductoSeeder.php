<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;

class CategoriaProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = Producto::all();
        $categorias = Categoria::all();

        if ($productos->isEmpty() || $categorias->isEmpty()) {
            echo "No hay productos o categorías disponibles.\n";
            return;
        }

        foreach ($productos as $producto) {
            // Asignar de 1 a 2 categorías aleatorias a cada producto
            $cats = $categorias->random(rand(1, 2));
            foreach ($cats as $categoria) {
                DB::table('categoria_producto')->insert([
                    'producto_id' => $producto->id,
                    'categoria_id' => $categoria->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "Registros insertados en categoria_producto correctamente\n";
    }
}