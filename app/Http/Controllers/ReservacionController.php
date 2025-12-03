<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservacion; 
use App\Models\Canchas;      
use App\Models\User;        
use Carbon\Carbon;          

class ReservacionController extends Controller
{
    public function store(Request $request)
    {
        // 1. VALIDAR DATOS DEL FORMULARIO
        $request->validate([
            'cancha_id'   => 'required|exists:canchas_tabla,id', 
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required', 
        ]);

        $usuario = Auth::user();
        $cancha_id = $request->cancha_id;

        // 2. CONSTRUIR FECHAS CARBON
        $fecha_inicio = Carbon::parse($request->fecha . ' ' . $request->hora_inicio);
        
        $fecha_fin = $fecha_inicio->copy()->addHour();

        // 3. VALIDACIÓN DE DISPONIBILIDAD 
        $existeConflicto = Reservacion::where('cancha_id', $cancha_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->whereBetween('hora_inicio', [$fecha_inicio, $fecha_fin])
                      ->orWhereBetween('hora_fin', [$fecha_inicio, $fecha_fin])
                      ->orWhere(function ($q) use ($fecha_inicio, $fecha_fin) {
                          $q->where('hora_inicio', '<', $fecha_inicio)
                            ->where('hora_fin', '>', $fecha_fin);
                      });
            })
            ->where('reservacion_estatus', '!=', 'Cancelada') 
            ->exists();

        if ($existeConflicto) {
            return back()->withErrors(['error' => '¡Lo sentimos! Ese horario ya está ocupado.']);
        }

        // 4. PRECIO
        $cancha = \App\Models\Canchas::find($cancha_id);
        $precioTotal = $cancha->precio_por_hora; 

        // 5. CREAR
        Reservacion::create([
            'user_id'             => $usuario->id,
            'cancha_id'           => $cancha_id,
            'hora_inicio'         => $fecha_inicio,
            'hora_fin'            => $fecha_fin,
            'precio_total'        => $precioTotal,
            'metodo_pago'         => 'EnSitio', 
            'pago_estatus'        => 'PendienteEnSitio',
            'reservacion_estatus' => 'Confirmada'
        ]);

        // 6. REDIRECCIONAR AL DASHBOARD
        return redirect('/mi-dashboard')->with('success', '¡Reserva confirmada con éxito!');
    }

    /**
     * Cancela una reserva si cumple con las reglas.
     */
    public function cancel($id)
    {
        // 1. Buscar la reserva
        $reserva = \App\Models\Reservacion::find($id);

        if (!$reserva) {
            return back()->with('error', 'Reserva no encontrada.');
        }

        $usuarioLogueado = \Illuminate\Support\Facades\Auth::user();

        $esDuenio = $reserva->user_id === $usuarioLogueado->id;

        $esAdmin = $usuarioLogueado->role->nombre === 'AdminCancha';

       if (!$esDuenio && !$esAdmin) {
            return back()->with('error', 'No tienes permiso para cancelar esta reserva.');
        }

        // 4. REGLA DE NEGOCIO (Tiempo límite)
        // Esta regla solo aplica si eres el CLIENTE. El Admin debería poder cancelar cuando sea.
        if (!$esAdmin) {
            $limiteCancelacion = \Carbon\Carbon::parse($reserva->hora_inicio)->subDay();

            if (now() > $limiteCancelacion) {
                return back()->with('error', 'Lo sentimos, solo puedes cancelar con 24 horas de anticipación.');
            }
        }

        // 4. EJECUTAR CANCELACIÓN
        $reserva->reservacion_estatus = 'Cancelada';
        $reserva->save();

        return back()->with('success', 'La reserva ha sido cancelada correctamente.');
    }

    public function create($id)
    {
        $cancha = \App\Models\Canchas::findOrFail($id);
        return view('reservas.cancha-disponibilidad', compact('cancha'));
    }
}