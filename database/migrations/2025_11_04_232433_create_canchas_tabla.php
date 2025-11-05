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
        Schema::create('canchas_tabla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_complejo')->constrained('complejos_tabla');
            $table->string('nombre');
            $table->string('tipo_deporte'); 
            $table->decimal('precio_por_hora', 8, 2);
            $table->text('descripcion')->nullable();
            $table->string('imagen_url')->nullable(); 
            $table->string('status')->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canchas_tabla');
    }
};
