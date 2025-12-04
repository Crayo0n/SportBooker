<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener el Cliente de prueba (Juan Pérez)
        $cliente = DB::table('users')->where('email', 'cliente@test.com')->first();
        
        // 2. Obtener una Cancha (La primera que encuentre)
        $cancha = DB::table('canchas_tabla')->first();

        // Validación de seguridad por si no corrieron los seeders anteriores
        if (!$cliente || !$cancha) {
            $this->command->info('⚠️ No se encontraron usuarios o canchas. Ejecuta UsuariosSeeder y CanchasSeeder primero.');
            return;
        }

        $precio = $cancha->precio_por_hora; 
        $now = Carbon::now();

        $reservas = [
            // --- CASO 1: RESERVA PASADA (Ya jugada y pagada) ---
            [
                'user_id'             => $cliente->id,
                'cancha_id'           => $cancha->id,
                'hora_inicio'         => $now->copy()->subDays(5)->setHour(19)->setMinute(0), 
                'hora_fin'            => $now->copy()->subDays(5)->setHour(21)->setMinute(0),
                'precio_total'        => $precio * 2,
                'metodo_pago'         => 'Tarjeta',
                'pago_estatus'        => 'Pagado',
                'reservacion_estatus' => 'Confirmada', // O 'Finalizada' si usas ese estado
                'created_at'          => $now->copy()->subDays(10),
                'updated_at'          => $now->copy()->subDays(10),
            ],

            // --- CASO 2: RESERVA FUTURA (Para jugar pronto, pago en sitio) ---
            [
                'user_id'             => $cliente->id,
                'cancha_id'           => $cancha->id,
                'hora_inicio'         => $now->copy()->addDays(2)->setHour(20)->setMinute(0), // En 2 días a las 8 PM
                'hora_fin'            => $now->copy()->addDays(2)->setHour(21)->setMinute(0), // 1 hora
                'precio_total'        => $precio,
                'metodo_pago'         => 'EnSitio',
                'pago_estatus'        => 'PendienteEnSitio',
                'reservacion_estatus' => 'Confirmada',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],

            // --- CASO 3: RESERVA CANCELADA (Historial) ---
            [
                'user_id'             => $cliente->id,
                'cancha_id'           => $cancha->id,
                'hora_inicio'         => $now->copy()->addDays(5)->setHour(10)->setMinute(0), // Iba a ser en 5 días
                'hora_fin'            => $now->copy()->addDays(5)->setHour(11)->setMinute(0),
                'precio_total'        => $precio,
                'metodo_pago'         => 'EnSitio',
                'pago_estatus'        => 'PendienteEnSitio',
                'reservacion_estatus' => 'Cancelada',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
        ];

        DB::table('reservaciones_tabla')->insert($reservas);
    }
}
