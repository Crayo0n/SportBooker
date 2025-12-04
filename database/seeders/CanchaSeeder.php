<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon; 

class CanchasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buscamos un ID de complejo válido para no romper la relación
        $complejo = DB::table('complejos_tabla')->first();
        
        
        $idComplejo = $complejo ? $complejo->id : 1;

        // 2. Array de Canchas variadas
        $canchas = [
            [
                'id_complejo'     => $idComplejo,
                'nombre'          => 'Estadio Principal "El 10"',
                'tipo_deporte'    => 'Fútbol',
                'precio_por_hora' => 550.00,
                'descripcion'     => 'Cancha de fútbol 11 con pasto natural y gradas. Iluminación profesional.',
                'status'          => 'Disponible',
                'imagen_url'      => null, 
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'id_complejo'     => $idComplejo,
                'nombre'          => 'Cancha Rápida #1',
                'tipo_deporte'    => 'Fútbol',
                'precio_por_hora' => 350.00,
                'descripcion'     => 'Fútbol 7, pasto sintético. Ideal para retas nocturnas.',
                'status'          => 'Disponible',
                'imagen_url'      => null, 
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'id_complejo'     => $idComplejo,
                'nombre'          => 'Pista Central',
                'tipo_deporte'    => 'Pádel',
                'precio_por_hora' => 400.00,
                'descripcion'     => 'Cancha de cristal panorámica, superficie azul oficial WPT.',
                'status'          => 'Disponible',
                'imagen_url'      => null, 
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'id_complejo'     => $idComplejo,
                'nombre'          => 'Duela 1',
                'tipo_deporte'    => 'Basquetbol',
                'precio_por_hora' => 300.00,
                'descripcion'     => 'Cancha techada con piso de duela y tableros de acrílico.',
                'status'          => 'En Mantenimiento', 
                'imagen_url'      => null,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'id_complejo'     => $idComplejo,
                'nombre'          => 'Cancha de Arcilla',
                'tipo_deporte'    => 'Tenis',
                'precio_por_hora' => 450.00,
                'descripcion'     => 'Superficie de arcilla roja, requiere calzado especial.',
                'status'          => 'Disponible',
                'imagen_url'      => null,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
        ];

        DB::table('canchas_tabla')->insert($canchas);
    }
}
