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
        Schema::create('bloqueos_admin_tabla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cancha_id')->constrained('canchas_tabla');
            $table->foreignId('creada_por')->constrained('users'); 
            $table->dateTime('hora_inicio'); 
            $table->dateTime('hora_fin');
            $table->string('rason')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloqueos_admin_tabla');
    }
};
