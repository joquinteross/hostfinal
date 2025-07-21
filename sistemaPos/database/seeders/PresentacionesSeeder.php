<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Caracteristica;

class PresentacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $caracteristicas = Caracteristica::inRandomOrder()->take(10)->pluck('id');

        foreach ($caracteristicas as $id) {
            DB::table('presentaciones')->insert([
                'caracteristica_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
