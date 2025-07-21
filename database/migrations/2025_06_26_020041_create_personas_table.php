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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('direccion')->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('documento_id')->constrained()->cascadeOnDelete();
            $table->string('numero_documento', 20);
            $table->enum('tipo_persona', ['NATURAL', 'JURIDICA']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
