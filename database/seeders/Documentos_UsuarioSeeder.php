<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buscamos los IDs de los usuarios de prueba
        $clienteOcasional = DB::table('users')->where('email', 'cliente@test.com')->first();
        $clienteEquipo    = DB::table('users')->where('email', 'equipo@test.com')->first();
        
        // Array para acumular todos los insert
        $documentos = [];
        $now = Carbon::now();

        // --- 2. DOCUMENTOS DEL CLIENTE OCASIONAL (2 Docs) ---
        if ($clienteOcasional) {
            $documentos[] = [
                'user_id'             => $clienteOcasional->id,
                'tipo'                => 'INE',
                'file_path'           => 'documentos/seeder_ine_front.jpg', 
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
            $documentos[] = [
                'user_id'             => $clienteOcasional->id,
                'tipo'                => 'ComprobanteDomicilio',
                'file_path'           => 'documentos/seeder_comprobante.pdf',
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
        }

        // --- 3. DOCUMENTOS DEL CLIENTE RECURRENTE (5 Docs) ---
        if ($clienteEquipo) {
            $docsEquipo = [
                'INE', 
                'ComprobanteDomicilio', 
                'OficioPeticion', 
                'RosterLiga', 
                'CertificadoMedico'
            ];

            foreach ($docsEquipo as $tipo) {
                $documentos[] = [
                    'user_id'             => $clienteEquipo->id,
                    'tipo'                => $tipo,
                    'file_path'           => 'documentos/seeder_' . strtolower($tipo) . '.pdf',
                    'created_at'          => $now,
                    'updated_at'          => $now,
                ];
            }
        }

        // 4. Insertar todo
        if (count($documentos) > 0) {
            DB::table('documentos_usuarios_tabla')->insert($documentos);
        }
    }
}
