<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin_bloqueos; 
use App\Models\Reservacion;
use App\Models\Canchas;
use App\Models\Complejos;
use Carbon\Carbon;

class BloqueoController extends Controller
{
    /**
     * Función privada para obtener el complejo del admin logueado.
     */
    private function getAdminComplex()
    {
        return Auth::user()->complex; 
    }

    /**
     * CREATE (Crear): Crea un nuevo bloqueo de mantenimiento.
     */
    public function store()
    {
        $complejo = $this->getAdminComplex();
        if (!$complejo) {
            return response()->json(['error' => 'No tienes un complejo asignado.'], 403);
        }

        // --- Datos de prueba (en la vida real vendrían de un formulario) ---
        $id_cancha_a_bloquear = 1; 
        $fecha_inicio_bloqueo = Carbon::today()->setHour(21)->setMinute(0);
        $fecha_fin_bloqueo    = Carbon::today()->setHour(22)->setMinute(0);
        $motivo_bloqueo       = "Mantenimiento Eléctrico";

        // 1. VERIFICAR PERMISO
        // Validamos que la cancha que intenta bloquear (ID 1) sea suya.
        $cancha = Canchas::find($id_cancha_a_bloquear);
        if (!$cancha || $cancha->id_complejo !== $complejo->id) {
            return response()->json(['error' => 'Esta cancha no existe o no te pertenece.'], 404);
        }

        // 2. VERIFICAR CONFLICTOS DE RESERVAS
        // Buscamos si ya existe una RESERVA de un cliente en ese horario.
        $conflictoReserva = Reservacion::where('cancha_id', $id_cancha_a_bloquear)
            ->where(function ($query) use ($fecha_inicio_bloqueo, $fecha_fin_bloqueo) {
                // Lógica para detectar empalmes
                $query->where('hora_inicio', '<', $fecha_fin_bloqueo)
                      ->where('hora_fin', '>', $fecha_inicio_bloqueo);
            })
            ->where('reservacion_estatus', '!=', 'Cancelada')
            ->exists();

        if ($conflictoReserva) {
            return response()->json([
                'error' => 'No puedes bloquear este horario. Ya existe una reserva de cliente.'
            ], 409); 
        }

        // 3. CREAR EL BLOQUEO
        $bloqueo = Admin_bloqueos ::create([
            'cancha_id'          => $id_cancha_a_bloquear,
            'creada_por' => Auth::id(), 
            'hora_inicio'       => $fecha_inicio_bloqueo,
            'hora_fin'          => $fecha_fin_bloqueo,
            'rason'             => $motivo_bloqueo,
        ]);

        return response()->json([
            'mensaje' => '¡Horario bloqueado por mantenimiento con éxito!',
            'bloqueo' => $bloqueo
        ], 201);
    }
}