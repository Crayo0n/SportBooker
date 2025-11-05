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
        Schema::create('horarios_operacion_tabla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_complejo')->constrained('complejos_tabla')->onDelete('cascade');
            $table->unsignedTinyInteger('dia_semana');
            $table->time('hora_apertura')->nullable();
            $table->time('hora_cierre')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->unique(['id_complejo', 'dia_semana']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_operacion_tabla');
    }
};
