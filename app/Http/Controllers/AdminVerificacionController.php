<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Documentos_Usuario;

class AdminVerificacionController extends Controller
{
    /**
     * 1. LISTAR PENDIENTES
     * Muestra todos los usuarios que requieren revisión.
     */
    public function index()
    {
        $usuariosPendientes = User::where('status', 'PendienteVerificacion')
                                  ->with('documents') 
                                  ->get();

        return response()->json([
            'mensaje' => 'Cola de verificación cargada',
            'cantidad' => $usuariosPendientes->count(),
            'usuarios' => $usuariosPendientes
        ]);
    }

    /**
     * 2. APROBAR USUARIO
     * Recibe el ID del usuario y cambia su estatus.
     */
    public function aprobar($id)
    {
        // Buscamos al usuario por ID
        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Validamos que realmente esté pendiente (opcional, pero buena práctica)
        if ($usuario->status !== 'PendienteVerificacion') {
            return response()->json(['mensaje' => 'Este usuario ya fue procesado antes.'], 400);
        }

        // --- LA ACCIÓN DE APROBAR ---
        $usuario->status = 'Aprobado';
        $usuario->save(); // Guardamos el cambio en la BD

        // (Aquí podrías disparar un envío de correo notificando al usuario)

        return response()->json([
            'mensaje' => 'Usuario aprobado exitosamente.',
            'usuario_id' => $usuario->id,
            'nuevo_status' => $usuario->status
        ]);
    }
}