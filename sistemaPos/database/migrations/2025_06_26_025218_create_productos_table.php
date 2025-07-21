<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre',80);
            $table->integer('stock')->unsigned()->default(0);
            $table->text('descripcion',255)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('img_path', 2048)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->decimal('precio', 8, 2, true)->nullable();          
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->onDelete('cascade');
            $table->foreignId('presentacione_id')->constrained('presentaciones')->onDelete('cascade');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
