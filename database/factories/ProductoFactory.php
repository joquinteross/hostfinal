<?php

namespace Database\Factories;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Presentacione;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->bothify('PROD-###??'),
            'nombre' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(10, 200),
            'descripcion' => $this->faker->optional()->sentence(),
            'fecha_vencimiento' => optional($this->faker->optional()->dateTimeBetween('+1 month', '+2 years'))->format('Y-m-d'),
            'img_path' => $this->faker->optional()->imageUrl(640, 480, 'products'),
            'estado' => 1,
            'precio' => $this->faker->randomFloat(2, 1000, 100000),
            'marca_id' => Marca::inRandomOrder()->first()?->id,
            'presentacione_id' => Presentacione::inRandomOrder()->first()?->id,
            'categoria_id' => Categoria::inRandomOrder()->first()?->id,
        ];
    }
}
