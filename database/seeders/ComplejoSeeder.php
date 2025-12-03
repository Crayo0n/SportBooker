<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComplejoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complejos_tabla')->insert([
            [
                // 2. Asegúrate que el usuario ID 1 exista y sea Admin.
                'admin_user_id' => 1, 
                
                'nombre' => 'Complejo Deportivo Central',
                'direccion' => 'Querétaro, Querétaro',
                'numero_contacto' => '4420000000',
                'imagen_url' => null, 
                'descripcion' => 'Complejo principal para pruebas del equipo.', 
                'status' => 'Activo', 
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}