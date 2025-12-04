<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservacion; 
use App\Models\Admin_bloqueos;  
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DisponibilidadController extends Controller
{
    public function consultar($cancha_id, Request $request)
    {
        try {
            $fecha = $request->query('fecha'); // YYYY-MM-DD
            
            if (!$fecha) {
                return response()->json(['error' => 'Falta la fecha'], 400);
            }

            $horaApertura = 8;
            $horaCierre = 22;

            // --- DEBUG: Verificar nombres de columnas ---
            // Asegúrate que en tu BD sean 'cancha_id', 'hora_inicio', 'reservacion_estatus'
            
            $reservas = Reservacion::where('cancha_id', $cancha_id)
                ->whereDate('hora_inicio', $fecha)
                ->where('reservacion_estatus', '!=', 'Cancelada')
                ->get(['hora_inicio', 'hora_fin']);

            // Asegúrate que en tu BD de bloqueos sean 'cancha_id', 'hora_inicio'
            $bloqueos = Admin_bloqueos::where('cancha_id', $cancha_id)
                ->whereDate('hora_inicio', $fecha)
                ->get(['hora_inicio', 'hora_fin']);

            $horasOcupadas = [];

            $llenarHoras = function($items) use (&$horasOcupadas) {
                foreach ($items as $item) {
                    // Si falla aquí, es porque las fechas en la BD no son válidas
                    $inicio = Carbon::parse($item->hora_inicio);
                    $fin    = Carbon::parse($item->hora_fin);

                    while ($inicio < $fin) {
                        $horasOcupadas[] = $inicio->format('H:i'); 
                        $inicio->addHour(); 
                    }
                }
            };

            $llenarHoras($reservas);
            $llenarHoras($bloqueos);

            $horariosDisponibles = [];
            for ($h = $horaApertura; $h < $horaCierre; $h++) {
                $horaStr = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
                
                if (!in_array($horaStr, $horasOcupadas)) {
                    // Devolvemos formato simple HH:MM
                    $horariosDisponibles[] = $horaStr; 
                }
            }

            return response()->json($horariosDisponibles);

        } catch (\Exception $e) {
            // ESTO NOS DIRÁ EL ERROR EXACTO EN LA CONSOLA
            Log::error("Error Disponibilidad: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}