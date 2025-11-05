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
        Schema::create('reservaciones_tabla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('cancha_id')->constrained('canchas_tabla');
            $table->dateTime('hora_inicio');
            $table->dateTime('hora_fin');
            $table->decimal('precio_total', 8, 2);
            $table->string('metodo_pago'); 
            $table->string('pago_estatus');
            $table->string('reservacion_estatus'); 
            $table->timestamps();
            $table->unique(['cancha_id', 'hora_inicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservaciones_tabla');
    }
};
