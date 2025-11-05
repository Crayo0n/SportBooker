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
        Schema::create('complejos_tabla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_user_id')->nullable()->unique()->constrained('users') ->onDelete('set null');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('numero_contacto');
            $table->string('imagen_url')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('status')->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complejos_tabla');
    }
};
