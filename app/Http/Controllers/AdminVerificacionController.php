<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Documentos_Usuario;
use Illuminate\Support\Facades\Storage;

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
                                  ->orderBy('created_at', 'asc')
                                  ->get();

        return view('superadmin.verificacion', compact('usuariosPendientes'));
    }

    /**
     * 2. APROBAR USUARIO
     * Recibe el ID del usuario y cambia su estatus.
     */
    public function aprobar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->status = 'Aprobado';
        $usuario->save();

        return redirect()->route('superadmin.verificacion.index')
            ->with('success', 'Usuario ' . $usuario->nombre . ' aprobado correctamente.');
    }

    /**
     * RECHAZAR USUARIO (NUEVO)
     */
    public function rechazar($id)
    {
        $usuario = User::findOrFail($id);
        // Aquí podríamos borrar los documentos o marcarlo como Rechazado
        $usuario->status = 'Rechazado';
        $usuario->save();

        return redirect()->route('superadmin.verificacion.index')
            ->with('error', 'Usuario ' . $usuario->nombre . ' ha sido rechazado.');
    }

    /**
     * DESCARGAR/VER DOCUMENTO SEGURO
     */
    public function descargarDocumento($id)
{
    $documento = Documentos_Usuario::findOrFail($id);

    // 1. Validamos que la ruta NO sea nula
    if (empty($documento->file_path)) {
        abort(404, 'Error: La ruta del archivo está vacía en la base de datos.');
    }

    // 2. Validamos que el archivo exista en el disco
    if (!Storage::disk('local')->exists($documento->file_path)) {
        abort(404, 'El archivo físico no se encuentra en el servidor.');
    }

    return Storage::disk('local')->response($documento->file_path);
}
}