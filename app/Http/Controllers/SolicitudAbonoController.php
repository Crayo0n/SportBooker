<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservaciones_Equipo; 
use App\Models\Canchas; 
use Carbon\Carbon;

class SolicitudAbonoController extends Controller
{
    /**
     * Muestra el formulario para solicitar abono.
     */
    public function create()
    {
        // Traemos todas las canchas disponibles
        // (Asegúrate que el nombre del modelo sea correcto, ej: Cancha o Canchas)
        $canchas = Canchas::where('status', 'Disponible')->get();
        
        return view('reservas.crear-reservacion-equipo', compact('canchas'));
    }

    /**
     * Almacena la solicitud con datos REALES del formulario.
     */
    public function store(Request $request)
    {
        // 1. VALIDAR LOS DATOS DEL FORMULARIO
        $request->validate([
            'cancha_id'    => 'required|exists:canchas_tabla,id', // Verifica el nombre de tu tabla de canchas
            'dia_semana'   => 'required|integer|between:0,6',
            'hora_inicio'  => 'required',
            'hora_fin'     => 'required|after:hora_inicio',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
        ]);

        // 2. CREAR LA SOLICITUD (Usando los datos del $request)
        $solicitud = Reservaciones_Equipo::create([
            'user_id'             => Auth::id(), // El usuario logueado
            'cancha_id'           => $request->cancha_id,
            'dia_semana'          => $request->dia_semana,
            'hora_inicio'         => $request->hora_inicio,
            'hora_fin'            => $request->hora_fin,
            'fecha_inicio'        => $request->fecha_inicio,
            'fecha_fin'           => $request->fecha_fin,
            'reservacion_estatus' => 'PendienteAprobacion' 
        ]);

        // 3. REDIRECCIONAR AL DASHBOARD (No JSON)
        return redirect('/mi-dashboard')
            ->with('success', '¡Solicitud de abono enviada con éxito! El administrador revisará la disponibilidad.');
    }
}