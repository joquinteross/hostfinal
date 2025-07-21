<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persona;
use App\Models\Documento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    protected $model = Persona::class;

    public function definition()
    {
        return [
            'razon_social' => $this->faker->company,
            'direccion'    => $this->faker->address,
            'telefono'     => $this->faker->numerify('##########'), // nuevo campo
            'email'        => $this->faker->unique()->safeEmail,    // nuevo campo
            'tipo_persona' => $this->faker->randomElement(['natural', 'juridica']),
            'estado'       => 1,
            'documento_id' => Documento::inRandomOrder()->first()?->id ?? 1,
            'numero_documento' => $this->faker->unique()->numerify('##########')
        ];
    }
}
