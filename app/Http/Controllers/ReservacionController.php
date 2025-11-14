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
        // MODIFICACIÓN: Intentamos obtener al usuario logueado primero
        $usuario = Auth::user();

        // Si no estás logueado, entonces sí usamos el truco de agarrar al primero
        if (!$usuario) {
            $usuario = User::first();
        }
        
        // Validamos que exista ALGUN usuario
        if (!$usuario) {
             return response()->json(['error' => 'No hay usuarios en la BD. Crea uno primero.'], 404);
        }

        $usuario_id = $usuario->id;
        
        // ---------------------------------------------------------

        // 1. Simulamos datos de entrada
        // Intentamos reservar la Cancha 1 (o la primera que encuentres)
        $cancha_id = 1; 
        
        // FECHAS: Para evitar errores de "ya pasó", pondremos la reserva para MAÑANA
        $fecha_inicio = Carbon::tomorrow()->setHour(1)->setMinute(0)->setSecond(0);
        $fecha_fin    = Carbon::tomorrow()->setHour(2)->setMinute(0)->setSecond(0);
        $metodo_pago  = 'EnSitio';

        // 2. VALIDACIÓN DE DISPONIBILIDAD
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
            return response()->json(['error' => '¡Lo sentimos! Ese horario ya está ocupado.'], 409);
        }

        // 3. Obtener precio
        $cancha = Canchas::find($cancha_id);
        
        // Validación extra por si borraste la cancha
        if (!$cancha) {
            return response()->json(['error' => 'La cancha ID 1 no existe. Crea una primero.'], 404);
        }

        $horas = $fecha_inicio->diffInHours($fecha_fin);
        $precioTotal = $cancha->precio_por_hora * $horas;

        // 4. Crear la Reserva
        $reserva = Reservacion::create([
            'user_id'             => $usuario_id, // <-- Usamos el ID que obtuvimos arriba
            'cancha_id'           => $cancha_id,
            'hora_inicio'         => $fecha_inicio,
            'hora_fin'            => $fecha_fin,
            'precio_total'        => $precioTotal,
            'metodo_pago'         => $metodo_pago,
            'pago_estatus'        => 'PendienteEnSitio',
            'reservacion_estatus' => 'Confirmada'
        ]);

        return response()->json([
            'mensaje' => '¡Reserva creada con éxito!',
            'usuario' => $usuario->nombre, // Para que veas quién reservó
            'reserva' => $reserva
        ]);
    }
}