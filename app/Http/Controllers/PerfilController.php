<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Documentos_Usuario;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Muestra el formulario con los datos del usuario.
     */
    public function ver()
    {
        $user = Auth::user();
        return view('perfil.perfil', compact('user'));
    }

    public function editar()
    {
        $user = Auth::user();
        return view('perfil.editar', compact('user'));
    }

    /**
     * Procesa la actualización de datos.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validaciones
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // 2. Actualizar datos básicos
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->phone_number = $request->telefono;

        // 3. Actualizar contraseña (solo si el campo no está vacío)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Tu perfil ha sido actualizado correctamente.');
    }

    public function verDocumento($id)
    {
        $documento = Documentos_Usuario::findOrFail($id);

        // 1. SEGURIDAD: Verificar que el documento pertenezca al usuario logueado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este documento.');
        }

        // 2. Obtener la ruta del archivo
        $ruta = $documento->file_path ?? $documento->ruta_archivo;

        // 3. Verificar existencia física
        if (!$ruta || !Storage::disk('local')->exists($ruta)) {
            abort(404, 'El archivo no se encuentra en el servidor.');
        }

        // 4. Devolver el archivo para visualización
        return Storage::disk('local')->response($ruta);
    }
}