<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DocumentosSeeder::class,
            ComprobanteSeeder::class,
            PersonasSeeder::class,
            ProveedoresSeeder::class,
            UserSeeder::class,
            CaracteristicasSeeder::class,
            MarcasSeeder::class,
            PresentacionesSeeder::class,
            CategoriasSeeder::class,
            ProductosSeeder::class,
            ClientesSeeder::class,
            VentasSeeder::class,
            ComprasSeeder::class,
            ProductoVentaSeeder::class,
            CompraProductoSeeder::class,
            CategoriaProductoSeeder::class,
            PermissionSeeder::class          
       
    ]);

       
         


    }
}
