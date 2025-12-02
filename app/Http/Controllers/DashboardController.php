<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservacion;
use App\Models\Complejos;
use App\Models\User;

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

            return view('dashboards.cliente', compact('misReservas'));
        }

        // --- CASO 2: ADMIN DE CANCHA ---
        if ($rolNombre === 'AdminCancha') {
            
            $miComplejo = Complejos::where('admin_user_id', $user->id)->first();

            // Si no tiene complejo
            if (!$miComplejo) {
                return view('dashboards.admin-cancha', [
                    'miComplejo' => null,
                    'reservas' => collect([]), // Colección vacía
                    'totalReservas' => 0,
                    'ingresosPendientes' => 0
                ]);
            }

            $reservasDelComplejo = Reservacion::whereHas('cancha', function ($query) use ($miComplejo) {
                $query->where('id_complejo', $miComplejo->id); 
            })
            ->with(['user', 'cancha']) 
            ->orderBy('hora_inicio', 'asc')
            ->get();

            $reservas = $reservasDelComplejo;

            $totalReservas = $reservas->count();
            $ingresosPendientes = $reservas->where('pago_estatus', '!=', 'Pagado')->sum('precio_total');

            // 4. Retornamos la vista
            return view('dashboards.admin-cancha', compact('miComplejo', 'reservas', 'totalReservas', 'ingresosPendientes'));
        }

        

        // Si llegamos aquí, es porque el nombre del rol no coincidió con los IFs
        return response()->json([
            'error' => 'Rol no reconocido en el sistema.',
            'rol_detectado' => $rolNombre
        ]);
    }
}