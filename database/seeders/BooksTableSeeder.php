<?php

namespace Database\Seeders;
use App\Models\Book;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'name' => 'El principito',
            'price' => 5000
        ]);

        Book::create([
            'name' => 'Caperucita',
            'price' => 2000
        ]);

        Book::create([
            'name' => 'Abogado del diablo',
            'price' => 1000
        ]);
    }
}
