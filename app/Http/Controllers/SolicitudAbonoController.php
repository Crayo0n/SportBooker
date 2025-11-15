<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservaciones_Equipo; 
use Carbon\Carbon;

class SolicitudAbonoController extends Controller
{
    /**
     * Almacena una NUEVA solicitud de abono del cliente.
     */
    public function store()
    {
        // 1. DATOS DE PRUEBA (Simulamos la solicitud)
        $usuario_id = Auth::id(); 
        $cancha_id  = 1;
        $dia_semana = Carbon::TUESDAY; 
        $hora_inicio_str = "20:00:00"; 
        $hora_fin_str    = "21:00:00";
        $fecha_inicio_abono = Carbon::parse('2025-12-01');
        $fecha_fin_abono    = Carbon::parse('2025-12-31');

        // 2. CREAR LA SOLICITUD
        $solicitud = Reservaciones_Equipo::create([
            'user_id'   => $usuario_id,
            'cancha_id'    => $cancha_id,
            'dia_semana'   => $dia_semana,
            'hora_inicio'  => $hora_inicio_str,
            'hora_fin'     => $hora_fin_str,
            'fecha_inicio' => $fecha_inicio_abono,
            'fecha_fin'    => $fecha_fin_abono,
            'reservacion_estatus'       => 'PendienteAprobacion' 
        ]);

        return response()->json([
            'mensaje' => '¡Solicitud de abono enviada con éxito! El administrador la revisará.',
            'solicitud' => $solicitud
        ], 201);
    }
}