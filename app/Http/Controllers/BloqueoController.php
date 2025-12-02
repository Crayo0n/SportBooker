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
     * 1. MOSTRAR FORMULARIO (GET)
     */
    public function create()
    {
        $complejo = $this->getAdminComplex();
        if (!$complejo) abort(403);

        $canchas = $complejo->canchas; 

        return view('admin-Cancha.bloqueos', compact('canchas'));
    }

    /**
     * 2. GUARDAR BLOQUEO (POST)
     */
    public function store(Request $request)
    {
        $complejo = $this->getAdminComplex();

        // Validación
        $request->validate([
            'cancha_id'    => 'required|exists:canchas_tabla,id',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'hora_inicio'  => 'required',
            'hora_fin'     => 'required|after:hora_inicio',
            'motivo'       => 'required|string|max:255'
        ]);

        // Unir fecha y hora con Carbon
        $inicio = Carbon::parse($request->fecha_inicio . ' ' . $request->hora_inicio);
        $fin    = Carbon::parse($request->fecha_inicio . ' ' . $request->hora_fin);

        // Validar conflicto con Reservas existentes
        $conflicto = Reservacion::where('cancha_id', $request->cancha_id)
            ->where('reservacion_estatus', '!=', 'Cancelada')
            ->where(function ($query) use ($inicio, $fin) {
                $query->where('hora_inicio', '<', $fin)
                      ->where('hora_fin', '>', $inicio);
            })->exists();

        if ($conflicto) {
            return back()->withErrors(['error' => 'No se puede bloquear: Ya hay reservas en ese horario.']);
        }

        // Crear Bloqueo
        Admin_bloqueos::create([
            'cancha_id'          => $request->cancha_id,
            'creada_por' => Auth::id(),
            'hora_inicio'        => $inicio,
            'hora_fin'           => $fin,
            'rason'             => $request->motivo
        ]);

        return redirect('/mi-dashboard')
            ->with('success', 'Bloqueo de mantenimiento creado exitosamente.');
    }
}