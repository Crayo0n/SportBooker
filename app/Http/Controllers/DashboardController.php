<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservacion;
use App\Models\Complejos;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'No has iniciado sesión.'], 401);
        }

        $user->load('role'); 

        if (!$user->role) {
             return response()->json(['error' => 'Usuario sin rol asignado.'], 500);
        }

        // --- CORRECCIÓN AQUÍ: Usamos 'nombre' ---
        $rolNombre = $user->role->nombre; 
        // ----------------------------------------

        // --- CASO 1: CLIENTE ---
        // Asegúrate que estos strings coincidan con lo que tienes en BD
        if ($rolNombre === 'ClienteOcasional' || $rolNombre === 'ClienteRecurrente') {
            
            $misReservas = Reservacion::where('user_id', $user->id) // O 'id_usuario' según tu BD
                            ->with(['cancha.complejo']) 
                            ->orderBy('hora_inicio', 'desc') // O 'fecha_inicio'
                            ->get();

            return response()->json([
                'rol' => $rolNombre,
                'mensaje' => 'Bienvenido a tu panel de cliente.',
                'mis_reservas' => $misReservas
            ]);
        }

        // --- CASO 2: ADMIN DE CANCHA ---
        if ($rolNombre === 'AdminCancha') {
            
            $miComplejo = Complejos::where('admin_user_id', $user->id)->first();

            if (!$miComplejo) {
                return response()->json(['mensaje' => 'Aún no tienes un complejo asignado.'], 200);
            }

            $reservasDelComplejo = Reservacion::whereHas('cancha', function ($query) use ($miComplejo) {
                // OJO: id_complejo según tu BD
                $query->where('id_complejo', $miComplejo->id); 
            })
            ->with(['user', 'cancha']) 
            ->orderBy('hora_inicio', 'asc')
            ->get();

            return response()->json([
                'rol' => $rolNombre,
                'mensaje' => 'Panel de Administración de: ' . $miComplejo->nombre,
                'reservas_totales' => $reservasDelComplejo->count(),
                'calendario' => $reservasDelComplejo
            ]);
        }

        // --- CASO 3: SUPERADMIN ---
        if ($rolNombre === 'SuperAdmin') {
            return response()->json([
                'rol' => 'SuperAdmin',
                'mensaje' => 'Panel Maestro',
                'stats' => [
                    'usuarios_totales' => User::count(),
                    'complejos_totales' => Complex::count(),
                    'reservas_totales' => Reservacion::count(),
                ]
            ]);
        }

        // Si llegamos aquí, es porque el nombre del rol no coincidió con los IFs
        return response()->json([
            'error' => 'Rol no reconocido en el sistema.',
            'rol_detectado' => $rolNombre
        ]);
    }
}