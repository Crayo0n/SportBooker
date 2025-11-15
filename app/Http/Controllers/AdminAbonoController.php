<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservaciones_Equipo;
use App\Models\Reservacion;
use App\Models\Admin_bloqueos;
use App\Models\Canchas;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminAbonoController extends Controller
{
    /**
     * Muestra al Admin todas las solicitudes pendientes de su complejo.
     */
    public function index()
    {
        $admin = Auth::user();
        $complejo = $admin->complex; 

        // Buscamos solicitudes de abono ('recurringRequests')
        // DONDE la cancha ('cancha') pertenezca a mi complejo
        $solicitudes = Reservaciones_Equipo::where('reservacion_estatus', 'PendienteAprobacion')
            ->whereHas('cancha', function ($query) use ($complejo) {
                $query->where('id_complejo', $complejo->id);
            })
            ->with(['user', 'cancha']) 
            ->get();

        return response()->json([
            'mensaje' => 'Solicitudes de abono pendientes para ' . $complejo->nombre,
            'solicitudes' => $solicitudes
        ]);
    }

    /**
     * APRUEBA una solicitud y genera TODAS las reservas.
     */
    public function approve($id_solicitud)
    {
        $solicitud = Reservaciones_Equipo::find($id_solicitud);
        if (!$solicitud) {
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

        $periodo = CarbonPeriod::create($solicitud->fecha_inicio, '1 day', $solicitud->fecha_fin);

        // 2. Filtra ese periodo para quedarnos solo con el día de la semana de la solicitud
        $fechasDelAbono = $periodo->filter(function ($date) use ($solicitud) {
        // '==' es más seguro por si los tipos no coinciden (ej. '2' vs 2)
             return $date->dayOfWeek == $solicitud->dia_semana; 
        });
        
        $conflictos = [];
        foreach ($fechasDelAbono as $fecha) {
            $fecha_inicio = $fecha->copy()->setTimeFromTimeString($solicitud->hora_inicio);
            $fecha_fin    = $fecha->copy()->setTimeFromTimeString($solicitud->hora_fin);

            $conflictoReserva = Reservacion::where('cancha_id', $solicitud->cancha_id)
                ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                    $query->where('hora_inicio', '<', $fecha_fin)
                          ->where('hora_fin', '>', $fecha_inicio);
                })->where('reservacion_estatus', '!=', 'Cancelada')->exists();
            
            $conflictoBloqueo = Admin_bloqueos::where('cancha_id', $solicitud->cancha_id)
                ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                    $query->where('hora_inicio', '<', $fecha_fin)
                          ->where('hora_fin', '>', $fecha_inicio);
                })->exists();

            if ($conflictoReserva || $conflictoBloqueo) {
                $conflictos[] = $fecha_inicio->toDateTimeString();
            }
        }
        
        if (!empty($conflictos)) {
            return response()->json([
                'error' => 'Acción bloqueada. No se puede aprobar porque choca con otras reservas/bloqueos.',
                'fechas_ocupadas' => $conflictos
            ], 409);
        }
        // --- Fin de la validación ---


        // --- CREACIÓN EN MASA ---
        $cancha = Canchas::find($solicitud->cancha_id);
        $precioHora = $cancha->precio_por_hora; 
        $reservasCreadas = 0;

        foreach ($fechasDelAbono as $fecha) {
            $fecha_inicio = $fecha->copy()->setTimeFromTimeString($solicitud->hora_inicio);
            $fecha_fin    = $fecha->copy()->setTimeFromTimeString($solicitud->hora_fin);

            Reservacion::create([
                'user_id'             => $solicitud->user_id,
                'cancha_id'           => $solicitud->cancha_id,
                'hora_inicio'         => $fecha_inicio,
                'hora_fin'            => $fecha_fin,
                'precio_total'        => $precioHora, 
                'metodo_pago'         => 'Abono',
                'pago_estatus'        => 'PendienteEnSitio',
                'reservacion_estatus' => 'Confirmada'
            ]);
            $reservasCreadas++;
        }

        // Marcamos la solicitud original como Aprobada
        $solicitud->reservacion_estatus = 'Aprobada';
        $solicitud->save();

        return response()->json([
            'mensaje' => '¡Abono Aprobado! Se generaron ' . $reservasCreadas . ' reservas nuevas.'
        ]);
    }
}