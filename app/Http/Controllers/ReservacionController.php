<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservacion; 
use App\Models\Canchas;      
use App\Models\User;        // Para asignar el usuario
use Carbon\Carbon;          // Para manejar fechas y horas

class ReservacionController extends Controller
{
    public function store(Request $request)
    {
        // 1. VALIDAR DATOS DEL FORMULARIO
        $request->validate([
            'cancha_id'   => 'required|exists:canchas_tabla,id', // Asegúrate del nombre de tu tabla
            'fecha'       => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required', // Viene como "18:00:00"
        ]);

        $usuario = Auth::user();
        $cancha_id = $request->cancha_id;

        // 2. CONSTRUIR FECHAS CARBON
        // El formulario manda fecha (2025-11-20) y hora (18:00:00) por separado.
        // Las unimos.
        $fecha_inicio = Carbon::parse($request->fecha . ' ' . $request->hora_inicio);
        
        // Asumimos reserva de 1 hora por defecto (puedes cambiarlo si pides hora fin)
        $fecha_fin = $fecha_inicio->copy()->addHour();

        // 3. VALIDACIÓN DE DISPONIBILIDAD (Misma lógica de antes)
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
            // En lugar de JSON, devolvemos error a la vista
            return back()->withErrors(['error' => '¡Lo sentimos! Ese horario ya está ocupado.']);
        }

        // 4. PRECIO
        $cancha = \App\Models\Cancha::find($cancha_id);
        $precioTotal = $cancha->precio_por_hora; // Por 1 hora

        // 5. CREAR
        Reservacion::create([
            'user_id'             => $usuario->id,
            'cancha_id'           => $cancha_id,
            'hora_inicio'         => $fecha_inicio,
            'hora_fin'            => $fecha_fin,
            'precio_total'        => $precioTotal,
            'metodo_pago'         => 'EnSitio', // Por defecto
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
            // Usamos 'subDay()' para restar un día a la fecha del juego
            $limiteCancelacion = \Carbon\Carbon::parse($reserva->hora_inicio)->subDay();

            if (now() > $limiteCancelacion) {
                return back()->with('error', 'Lo sentimos, solo puedes cancelar con 24 horas de anticipación.');
            }
        }

        // 4. EJECUTAR CANCELACIÓN
        //  solo cambiamos su estatus
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